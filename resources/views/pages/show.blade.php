@extends('layouts.frontend')

@section('title', $page->getLocalizedTranslation('meta_title', app()->getLocale()) ?: $page->getLocalizedTranslation('title', app()->getLocale()))
@section('description', $page->getLocalizedTranslation('meta_description', app()->getLocale()))

@section('content')
<section class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="fade-in">
                    <h1 class="section-title">{{ $page->getLocalizedTranslation('title', app()->getLocale()) }}</h1>
                    <div class="content mt-5">
                        {!! $page->getLocalizedTranslation('content', app()->getLocale()) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection