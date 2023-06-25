@extends ('forum::master', ['category' => null, 'thread' => null, 'breadcrumbs_append' => [trans('forum::general.manage')]])

@section ('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="row">
                <h2 class="text-center">Manage</h2>
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


    <div class="d-flex flex-row justify-content-between mb-2">

        @can ('createCategories')
            <button type="button" class="btn btn-primary" data-open-modal="create-category">
                {{ trans('forum::categories.create') }}
            </button>

            @include ('forum::category.modals.create')
        @endcan
    </div>

    <div class="v-manage-categories">
        <draggable-category-list :categories="categories"></draggable-category-list>

        <transition name="fade">
            <div v-show="changesApplied" class="alert alert-success mt-3" role="alert">
                {{ trans('forum::general.changes_applied') }}
            </div>
        </transition>

        <div class="text-end py-3">
            <button type="button" class="btn btn-primary px-5" :disabled="isSavingDisabled" @click="onSave">
                {{ trans('forum::general.save') }}
            </button>
        </div>
    </div>

    <script type="text/x-template" id="draggable-category-list-template">
        <draggable tag="ul" class="list-group" :list="categories" group="categories" :invertSwap="true" :emptyInsertThreshold="14">
            <li class="list-group-item" v-for="category in categories" :data-id="category.id" :key="category.id">
                <a class="float-end btn btn-sm btn-danger ml-2" :href="`${category.route}#modal=delete-category`">{{ trans('forum::general.delete') }}</a>
                <a class="float-end btn btn-sm btn-link ml-2" :href="`${category.route}#modal=edit-category`">{{ trans('forum::general.edit') }}</a>
                <strong :style="{ color: category.color }">@{{ category.title }}</strong>
                <div class="text-muted">@{{ category.description }}</div>

                <draggable-category-list :categories="category.children"></draggable-category-list>
            </li>
        </draggable>
    </script>

    <script>
    var draggableCategoryList = {
        name: 'draggable-category-list',
        template: '#draggable-category-list-template',
        props: ['categories']
    };

    new Vue({
        el: '.v-manage-categories',
        name: 'ManageCategories',
        components: {
            draggableCategoryList
        },
        data: {
            categories: @json($categories),
            isSavingDisabled: true,
            changesApplied: false
        },
        watch: {
            categories: {
                handler: function (categories) {
                    this.isSavingDisabled = false;
                },
                deep: true
            }
        },
        methods: {
            onSave ()
            {
                this.isSavingDisabled = true;
                this.changesApplied = false;

                var payload = { categories: this.categories };
                axios.post('{{ route('forum.bulk.category.manage') }}', payload)
                    .then(response => {
                        this.changesApplied = true;
                        setTimeout(() => this.changesApplied = false, 3000);
                    })
                    .catch(error => {
                        this.isSavingDisabled = false;
                        console.log(error);
                    });
            }
        }
    });
    </script>
@stop