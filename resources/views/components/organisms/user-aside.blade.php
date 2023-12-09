<section class="w-36 m-auto sm:m-0">
    <div class="text-center pb-8">
        <figure>
            <x-atoms.avatar :user="$user" type="users-show"></x-atoms.avatar>
        </figure>
        <div>
            <div class="font-bold">{{ $user->name }}</div>
        </div>
    </div>
    <div>
        <dl class="flex justify-between">
            <dt class="font-bold text-sm">{{ __('messages.post_count') }}</dt>
            <dd class="text-sm">12345</dd>
        </dl>
        <dl class="flex justify-between">
            <dt class="font-bold text-sm">{{ __('messages.following') }}</dt>
            <dd class="text-sm">123</dd>
        </dl>
        <dl class="flex justify-between">
            <dt class="font-bold text-sm">{{ __('messages.followers') }}</dt>
            <dd class="text-sm">123</dd>
        </dl>
    </div>
</section>
