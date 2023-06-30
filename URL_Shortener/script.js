document.getElementById('urlForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const originalUrl = document.getElementById('originalUrl').value;
    
    
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'shorten.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            document.getElementById('shortenedUrl').href = response.shortUrl;
            document.getElementById('shortenedUrl').textContent = response.shortUrl;
            document.getElementById('shortenedUrlContainer').style.display = 'block';
        }
    };
    xhr.send('url=' + encodeURIComponent(originalUrl));
});
