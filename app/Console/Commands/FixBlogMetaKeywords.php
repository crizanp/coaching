<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Blog;

class FixBlogMetaKeywords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:blog-meta-keywords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix double-encoded meta_keywords in blog data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fixing blog meta_keywords data...');

        $blogs = Blog::all();
        $fixed = 0;

        foreach ($blogs as $blog) {
            // Get the raw attribute value to check the actual data type
            $rawMetaKeywords = $blog->getAttributes()['meta_keywords'] ?? null;
            
            if (is_string($rawMetaKeywords)) {
                // Try to decode the JSON string
                $decoded = json_decode($rawMetaKeywords, true);
                
                if (is_array($decoded)) {
                    $blog->meta_keywords = $decoded;
                    $blog->save();
                    $this->info("Fixed blog ID: {$blog->id} - {$blog->title}");
                    $fixed++;
                } else {
                    // If it's not JSON, try to convert comma-separated string to array
                    $keywords = array_map('trim', explode(',', $rawMetaKeywords));
                    $blog->meta_keywords = $keywords;
                    $blog->save();
                    $this->info("Converted blog ID: {$blog->id} - {$blog->title}");
                    $fixed++;
                }
            } elseif (is_array($blog->meta_keywords)) {
                $this->info("Blog ID: {$blog->id} already has correct format");
            }
        }

        $this->info("Fixed {$fixed} blog records.");
    }
}
