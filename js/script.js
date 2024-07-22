document.addEventListener('DOMContentLoaded', function() {
    const getKeyBtn = document.getElementById('getKeyBtn');
    const keyContainer = document.getElementById('keyContainer');
    const keyForm = document.getElementById('keyForm');
    const getKeyInput = document.getElementById('getKeyInput');
    const submitKeyBtn = document.getElementById('submitKeyBtn');

    getKeyBtn.addEventListener('click', function() {
        fetch('get_key.php')
            .then(response => response.json())
            .then(data => {
                if (data.access_token) {
                    keyContainer.textContent = data.access_token;
                    getKeyInput.value = data.access_token;
                } else {
                    keyContainer.textContent = 'Не вдалося отримати ключ';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                keyContainer.textContent = 'Помилка отримання ключа';
            });
    });

    keyForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const key = getKeyInput.value;

        fetch('download_file.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `key=${key}`
        })
        .then(response => response.blob())
        .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = 'file.xml';
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
        })
        .catch(error => console.error('Error:', error));
    });
});