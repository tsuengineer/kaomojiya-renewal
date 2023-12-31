<div class="flex justify-between relative">
    <div onclick="clickFacemark({{ json_encode($facemark->data) }}, '{{ $facemark->ulid }}')">
        {{ $facemark->data }}
    </div>
    <div id="{{ $facemark->ulid }}" class="facemark-menu flex items-center">
        <div onclick="toggleMenu('{{ $facemark->ulid }}', '{{ $prefix }}')">
            <x-atoms.icon-three-point-leader></x-atoms.icon-three-point-leader>
        </div>
    </div>
    <div class="menu-options hidden bg-white border rounded shadow right-0 top-6 absolute z-10 w-48"
         id="menu-options-{{ $prefix }}{{ $facemark->ulid }}">
        <div class="flex justify-between">
            <p class="cursor-pointer hover:bg-gray-200 py-2 text-center w-full"
               onclick="clickFacemark({{ json_encode($facemark->data) }}, '{{ $facemark->ulid }}')">
                <i class="fa-regular fa-copy"></i>
            </p>
            <p class="cursor-pointer hover:bg-gray-200 text-center w-full" onclick="hideAllMenuOptions()">
                <a href="{{ route('facemarks.show', ['ulid' => $facemark->ulid]) }}" class="block py-2">
                    <i class="fa-solid fa-circle-info w-full h-full"></i>
                </a>
            </p>
            @if(Auth::check())
                @if(Auth::user()->hasFavorite($facemark->id))
                    <p class="cursor-pointer hover:bg-gray-200 py-2 text-center w-full"
                       onclick="clickFavorite({{ $facemark->id }})">
                        <button class="favoriteButton-{{ $facemark->id }} btn" data-action="remove"
                                data-facemark-id="{{ $facemark->id }}">
                            <i class="fa-solid fa-star text-yellow-500"></i>
                        </button>
                        <span
                            class="text-xs text-yellow-500 fav-count-{{ $facemark->id }}">{{ $facemark->favorites_count }}</span>
                    </p>
                @else
                    <p class="cursor-pointer hover:bg-gray-200 py-2 text-center w-full"
                       onclick="clickFavorite({{ $facemark->id }})">
                        <button class="favoriteButton-{{ $facemark->id }} btn" data-action="add"
                                data-facemark-id="{{ $facemark->id }}">
                            <i class="fa-regular fa-star"></i>
                        </button>
                        <span class="text-xs fav-count-{{ $facemark->id }}">{{ $facemark->favorites_count }}</span>
                    </p>
                @endif
            @endif
        </div>
    </div>
</div>

<script>
    function hideAllMenuOptions() {
        let allMenuOptions = document.querySelectorAll('.menu-options');

        allMenuOptions.forEach(function (item) {
            item.style.display = 'none';
        });
    }

    function toggleMenu(facemarkUlid, prefix) {
        let menuOptions = document.getElementById('menu-options-' + prefix + facemarkUlid);
        let allMenuOptions = document.querySelectorAll('.menu-options');

        allMenuOptions.forEach(function (item) {
            if (item.id !== 'menu-options-' + prefix + facemarkUlid) {
                item.style.display = 'none';
            }
        });

        menuOptions.style.display = (menuOptions.style.display === 'block') ? 'none' : 'block';
    }

    function clickFacemark(copyText, facemarkUlid) {
        fetch(`/facemarks/${facemarkUlid}/copy`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        });

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

    function clickFavorite(facemarkId) {
        const favoriteButtons = document.querySelectorAll('.favoriteButton-' + facemarkId);
        favoriteButtons.forEach(function (favoriteButton) {
            const action = favoriteButton.dataset.action;
            if (action === 'add') {
                addFavorite(facemarkId, favoriteButton);
            }
            if (action === 'remove') {
                removeFavorite(facemarkId, favoriteButton);
            }
        });
    }

    // いいね追加処理
    function addFavorite(facemarkId, button) {
        fetch(`/favorites/${facemarkId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
            .then(response => {
                if (response.ok) {
                    response.json().then(data => {
                        if (!data.success) {
                            return;
                        }
                        button.dataset.action = 'remove';
                        button.innerHTML = '<i class="fa-solid fa-star text-yellow-500"></i>';
                        const favCounts = document.querySelectorAll('.fav-count-' + facemarkId);
                        favCounts.forEach(function (favCount) {
                            favCount.innerText = data.favorite_count ?? 0;
                            favCount.classList.add('text-yellow-500');
                        });
                    });
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // いいね解除処理
    function removeFavorite(facemarkId, button) {
        fetch(`/favorites/${facemarkId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
            .then(response => {
                if (response.ok) {
                    response.json().then(data => {
                        if (!data.success) {
                            return;
                        }
                        button.dataset.action = 'add';
                        button.innerHTML = '<i class="fa-sharp fa-regular fa-star"></i>';
                        const favCounts = document.querySelectorAll('.fav-count-' + facemarkId);
                        favCounts.forEach(function (favCount) {
                            favCount.innerText = data.favorite_count ?? 0;
                            favCount.classList.remove('text-yellow-500');
                        });
                    });
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>
