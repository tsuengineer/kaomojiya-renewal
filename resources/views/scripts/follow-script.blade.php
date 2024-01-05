<script>
    function clickFollow(userId) {
        const followButtons = document.querySelectorAll('.followButton-' + userId);
        followButtons.forEach(function(followButton) {
            const action = followButton.dataset.action;
            if (action === 'add') {
                addFollow(userId, followButton);
            }
            if (action === 'remove') {
                removeFollow(userId, followButton);
            }
        });
    }

    // フォロー追加処理
    function addFollow(userId, button) {
        fetch(`/follows/${userId}`, {
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
                        button.classList.remove("border-blue-600", "text-blue-600", "hover:bg-blue-600");
                        button.classList.add("border-red-600", "text-red-600", "hover:bg-red-600");
                        button.innerText = @json(__('messages.unfollow'));
                        button.dataset.action = 'remove';
                    });
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // フォロー解除処理
    function removeFollow(userId, button) {
        fetch(`/follows/${userId}`, {
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
                        button.classList.add("border-blue-600", "text-blue-600", "hover:bg-blue-600");
                        button.classList.remove("border-red-600", "text-red-600", "hover:bg-red-600");
                        button.innerText = @json(__('messages.follow'));
                        button.dataset.action = 'add';
                    });
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>
