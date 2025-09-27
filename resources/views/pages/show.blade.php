@extends('layouts.frontend')

@section('title', $page->getTranslation('meta_title', app()->getLocale()) ?: $page->getTranslation('title', app()->getLocale()))
@section('description', $page->getTranslation('meta_description', app()->getLocale()))

@section('content')
<section class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="fade-in">
                    <h1 class="section-title">{{ $page->getTranslation('title', app()->getLocale()) }}</h1>
                    <div class="content mt-5">
                        {!! $page->getTranslation('content', app()->getLocale()) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection