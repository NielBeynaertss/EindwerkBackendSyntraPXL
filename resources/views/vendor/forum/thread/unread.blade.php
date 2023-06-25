@extends ('forum::master', ['thread' => null, 'breadcrumbs_append' => [trans('forum::threads.unread_updated')]])

@section ('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="row">
                <h2 class="text-center">Unread & updated threads</h2>
            </div>
            <hr>
        </div>
    </div>
    <nav class="v-navbar navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url(config('forum.web.router.prefix')) }}">Forum</a>
            <button class="navbar-toggler" type="button" :class="{ collapsed: isCollapsed }" @click="isCollapsed = ! isCollapsed">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" :class="{ show: !isCollapsed }">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url(config('forum.web.router.prefix')) }}">{{ trans('forum::general.index') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('forum.recent') }}">{{ trans('forum::threads.recent') }}</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('forum.unread') }}">{{ trans('forum::threads.unread_updated') }}</a>
                        </li>
                    @endauth
                    @can ('moveCategories')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('forum.category.manage') }}">{{ trans('forum::general.manage') }}</a>
                        </li>
                    @endcan
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

    @if (! $threads->isEmpty())
        @can ('markThreadsAsRead')
            <div class="text-center">
                <button class="btn btn-primary px-5" data-open-modal="mark-as-read">
                    <i data-feather="book"></i> {{ trans('forum::general.mark_read') }}
                </button>
            </div>

            @include ('forum::thread.modals.mark-as-read')
        @endcan
    @endif
@stop
