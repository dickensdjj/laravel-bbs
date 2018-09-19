@extends('layouts.app')

@section('title', isset($category)?$category->name: 'topic list')

@section('content')

<div class="row">
    <div class="col-lg-9 col-md-9 topic-list">

        @if (isset($category))
            <div class="alert alert-info" role="alert">
                {{ $category->name }} ：{{ $category->description }}
            </div>
        @endif

        <div class="panel panel-default">

            <div class="panel-heading">
                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="#">Last Reply</a></li>
                    <li role="presentation"><a href="#">Latest News</a></li>
                </ul>
            </div>

            <div class="panel-body">
                {{-- topic list --}}
                @include('topics._topic_list', ['topics' => $topics])
                {{-- pagination --}}

                {!! $topics->appends(Request::except('page'))->render() !!}
                {{-- append all params in URI except 'page' --}}

                {{-- {{ $topics ->links()}} --}}
                {{-- basic way to use page --}}

            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 sidebar">
        @include('topics._sidebar')
    </div>
</div>

@endsection