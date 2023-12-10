<div class="flex justify-between relative">
    <div onclick="clickFacemark('{{ $facemark->data }}')">
        {{ $facemark->data }}
    </div>
    <div id="{{ $facemark->ulid }}" class="facemark-menu flex items-center">
        <div onclick="toggleMenu('{{ $facemark->ulid }}')">
            <x-atoms.icon-three-point-leader></x-atoms.icon-three-point-leader>
        </div>
    </div>
    <div class="menu-options hidden bg-white border rounded shadow right-0 top-6 absolute z-10 w-48" id="menu-options-{{ $facemark->ulid }}">
        <p class="cursor-pointer hover:bg-gray-200 py-2 px-2" onclick="clickFacemark('{{ $facemark->data }}')">
            {{ __('messages.copy_facemark') }}
        </p>
        <p class="cursor-pointer hover:bg-gray-200 py-2 px-2" onclick="hideAllMenuOptions()">
            {{ __('messages.add_to_favorite') }}
        </p>
        <p class="cursor-pointer hover:bg-gray-200 py-2 px-2" onclick="hideAllMenuOptions()">
            <a href="{{ route('facemarks.show', ['ulid' => $facemark->ulid]) }}">
                {{ __('messages.details_of_this_facemark') }}
            </a>
        </p>
    </div>
</div>

<script>
    function hideAllMenuOptions() {
        let allMenuOptions = document.querySelectorAll('.menu-options');

        allMenuOptions.forEach(function (item) {
            item.style.display = 'none';
        });
    }

    function toggleMenu(facemarkUlid) {
        let menuOptions = document.getElementById('menu-options-' + facemarkUlid);
        let allMenuOptions = document.querySelectorAll('.menu-options');

        allMenuOptions.forEach(function (item) {
            if (item.id !== 'menu-options-' + facemarkUlid) {
                item.style.display = 'none';
            }
        });

        menuOptions.style.display = (menuOptions.style.display === 'block') ? 'none' : 'block';
    }

    function clickFacemark(copyText) {
        navigator.clipboard.writeText(copyText)
            .then(() => {
                Swal.fire({
                    toast: true,
                    text: copyText + "\n" + @json(__('messages.copied')),
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                });
            })
            .catch(e => {
                console.error(e);
            });

        hideAllMenuOptions();
    }
</script>
