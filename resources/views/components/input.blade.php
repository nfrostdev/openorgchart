<div class="field">
    <label for="{{ $id }}" class="label">{{ $label }}</label>
    <div class="control @if(isset($icon)) has-icons-left @endif">
        @if($type === 'select')
            <select id="{{ $id }}"
                    type="{{ $type }}"
                    class="input card @error($id) is-invalid @enderror"
                    name="{{ $id }}"
                {{ isset($autocomplete) ? 'autocomplete=' . $autocomplete : '' }}>
                {{ $slot }}
            </select>
        @else
            <input id="{{ $id }}"
                   type="{{ $type }}"
                   class="input card @error($id) is-invalid @enderror"
                   name="{{ $id }}"
                   value="{{ isset($value) ? $value : old($id) }}"
                   @if(isset($required) && $required) required @endif
                {{ isset($autocomplete) ? 'autocomplete=' . $autocomplete : '' }}/>
        @endif

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
