
<div class="filter-section mb-4">
    <form method="get" action="{{ url('dashboard') }}" class="row align-items-center g-2">
        <div class="col-md-9">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Pesquisar..." value="{{ request()->search }}">
                <span class="input-group-text">
                    <button type="submit" style="border: none; background: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                    </button>
                </span>
            </div>
        </div>
    </form>
</div>

 