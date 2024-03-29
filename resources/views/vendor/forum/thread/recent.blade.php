@extends ('forum::master', ['thread' => null, 'breadcrumbs_append' => [trans('forum::threads.recent')]])

@section ('content')
<link rel="stylesheet" href="{{ asset('css/forum.css') }}">
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="row">
                <h2 class="text-center">Recent threads</h2>
            </div>
            <hr>
        </div>
    </div>
    <nav class="v-navbar navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <button class="navbar-toggler" type="button" :class="{ collapsed: isCollapsed }" @click="isCollapsed = ! isCollapsed">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" :class="{ show: !isCollapsed }">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link forum-nav-link" href="{{ route('forum.recent') }}">{{ trans('forum::threads.recent') }}</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link forum-nav-link" href="{{ route('forum.unread') }}">{{ trans('forum::threads.unread_updated') }}</a>
                        </li>
                    @endauth
                    @if (auth()->user()->role_id == 1)
                        <li class="nav-item">
                            <a class="nav-link forum-nav-link" href="{{ route('forum.category.manage') }}">{{ trans('forum::general.manage') }}</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>


    <div id="new-posts">

        @if (! $threads->isEmpty())
            <div class="threads list-group my-3 shadow-sm">
                @foreach ($threads as $thread)
                    @include ('forum::thread.partials.list')
                @endforeach
            </div>
        @else
            <div class="card my-3">
                <div class="card-body text-center text-muted">
                    {{ trans('forum::threads.none_found') }}
                </div>
            </div>
        @endif
    </div>
@stop
