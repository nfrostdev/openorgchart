<form class="columns is-centered" onsubmit="showFilterLoading()">
    <label for="filter" class="label sr-only">Filter</label>
    <div class="field has-addons">
        <div class="control">
            <input id="filter"
                   type="search"
                   class="input card"
                   name="filter"
                   title="Filter"
                   placeholder="Search"
                   value="{{ request()->input('filter') ? request()->input('filter') : old('filter') }}"/>
        </div>
        <div class="control">
            <button type="submit" id="filter-button" class="button card">
                        <span class="icon is-small">
                            <span class="fas fa-filter"></span>
                        </span>
                <span>Filter</span>
            </button>
        </div>
    </div>
</form>

<script>
    function showFilterLoading() {
        document.getElementById('filter-button').classList.add('is-loading');
    }
</script>

