<div class="field">
    <label for="{{ $id }}" class="label">{{ $label }}</label>
    <div class="control @if(isset($icon)) has-icons-left @endif">
        <input id="{{ $id }}"
               type="{{ $type }}"
               class="input @error($id) is-invalid @enderror"
               name="{{ $id }}"
               value="{{ old($id) }}"
               @if(isset($required) && $required) required @endif
               autocomplete="{{ $autocomplete }}"/>
        @if(isset($icon))
            <span class="icon is-small is-left">
                <span class="fas {{ $icon }}"></span>
            </span>
        @endif
        @error($id)
        @if (isset($message))
            <strong class="help is-danger" role="alert">{{ $message }}</strong>
        @endif
        @enderror
    </div>
</div>
