<form method="POST"
      action="{{ $action }}"
      onsubmit="confirmDelete(event, '{{ $resource_name }}')"
      class="section has-text-centered">
    @csrf
    @method('DELETE')
    <button class="button card is-danger" title="Permanently Delete {{ $resource_name }}">Permanently Delete</button>
</form>

<script>
    function confirmDelete(event, resource) {
        if (!confirm("Are you sure you want to delete " + resource + "?\nThis action is permanent and cannot be undone!")) {
            event.preventDefault();
        }
    }
</script>
