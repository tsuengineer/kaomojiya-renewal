<section>
    <x-molecules.user-main-profile :user="$user"></x-molecules.user-main-profile>
    <x-molecules.user-main-facemarks :facemarks="$postFacemarks" prefix="post"></x-molecules.user-main-facemarks>
    <x-molecules.user-main-facemarks :facemarks="$favoriteFacemarks" prefix="favorite"></x-molecules.user-main-facemarks>
</section>
