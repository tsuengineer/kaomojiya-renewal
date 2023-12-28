<section>
    <x-molecules.user-main-profile :user="$user"></x-molecules.user-main-profile>
    <x-molecules.user-main-facemarks :user="$user" :facemarks="$postFacemarks" prefix="post"></x-molecules.user-main-facemarks>
    <x-molecules.user-main-facemarks :user="$user" :facemarks="$favoriteFacemarks" prefix="favorite"></x-molecules.user-main-facemarks>
</section>
