<div class="col-12 col-lg-3">
    <div class="blog-left-sidebar p-3 border">
        <form>
            <div class="position-relative blog-search mb-3">
                <input type="text" class="form-control form-control-lg rounded-0 pe-5"
                    placeholder="Serach posts here...">
                <div class="position-absolute top-50 end-0 translate-middle"><i class='bx bx-search fs-4 text-white'></i>
                </div>
            </div>
            <div class="blog-categories mb-3">
                <h5 class="mb-4">Blog Categories</h5>
                <div class="list-group list-group-flush">
                    @foreach ($blogCategories as $category)
                        <a href="{{ route('web.blog.category.all', $category->bc_url) }}"
                            class="list-group-item bg-transparent">
                            <i class='bx bx-chevron-right me-1'></i>
                            {{ $category->bc_name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </form>
    </div>
</div>
