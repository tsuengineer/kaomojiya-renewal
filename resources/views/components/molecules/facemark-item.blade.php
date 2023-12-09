<div class="flex justify-between relative">
    <div>
        {{ $facemark->data }}
    </div>
    <div id="{{ $facemark->ulid }}" class="facemark-menu flex items-center">
        <div onclick="toggleMenu('{{ $facemark->ulid }}')">
            <x-atoms.icon-three-point-leader></x-atoms.icon-three-point-leader>
        </div>
    </div>
    <div class="menu-options hidden bg-white border rounded p-2 right-0 top-6" id="menu-options-{{ $facemark->ulid }}" style="position: absolute; z-index: 1; width:200px; right:0; background:#fff">
        <p class="cursor-pointer hover:bg-gray-200 py-1 px-2">顔文字をコピーする</p>
        <p class="cursor-pointer hover:bg-gray-200 py-1 px-2">お気に入りに追加する</p>
        <p class="cursor-pointer hover:bg-gray-200 py-1 px-2">この顔文字の詳細</p>
    </div>
</div>

<script>
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
</script>
