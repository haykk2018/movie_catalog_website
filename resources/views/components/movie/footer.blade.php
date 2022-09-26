<!-- Footer -->
<footer class="w3-row-padding w3-padding-32">
    <div class="w3-third">
        <h3>QUOTES</h3>
        <p>If my films make one more person miserable, I’ll feel I have done my job.”
            - Woody Allen.
        </p>
        <p>“To be an artist means never to avert one's eyes.”

            - Akira Kurosawa.
        </p>
        <p>“If you want a happy ending, that depends, of course, on where you stop your story.”

            - Orson Welles.
        </p>
        <p>“I am a genre lover - everything from spaghetti western to samurai movie.“ - Quentin Tarantino</p>
    </div>

    <div class="w3-third">
        <h3>FILM POSTS</h3>
        <ul class="w3-ul w3-hoverable">
            <li class="w3-padding-16">
                <img src="https://www.w3schools.com/w3images/workshop.jpg" class="w3-left w3-margin-right"
                     style="width:50px">
                <span class="w3-large">Lorem</span><br>
                <span>Sed mattis nunc</span>
            </li>
            <li class="w3-padding-16">
                <img src="https://www.w3schools.com/w3images/gondol.jpg" class="w3-left w3-margin-right"
                     style="width:50px">
                <span class="w3-large">Ipsum</span><br>
                <span>Praes tinci sed</span>
            </li>
        </ul>
    </div>

    <div class="w3-third w3-serif">
        <h3>MOVIE GENRES</h3>
        <p>
            {{ $slot }}
        </p>
    </div>
</footer>

<!-- End page content -->
</div>
<script>
    // Script to open and close sidebar
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
    }

    //get movies part
    const alertPlaceholder = document.getElementById('liveAlertPlaceholder');

    function alert(message, type) {
        let wrapper = document.createElement('div');
        wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

        alertPlaceholder.append(wrapper)
    }

    async function fetchAndShow(url, innerPlaceId) {
        try {
            alertPlaceholder.innerHTML = '';
            let res = await fetch(url);
            if (res.ok) {
                document.getElementById(innerPlaceId).innerHTML = await res.text();
                document.getElementById('pagination').innerHTML = '';
            } else {
                alert('Tasks by that parameters don\'t exist or wrong connection ', 'warning')
            }
        } catch (error) {
            console.log(error);
        }
    }

    var lastSelectedCategory ='empty';

    async function showMoViesByCategory(category) {
        lastSelectedCategory = category;
        let url = window.location.origin + '/movies-by-category/' + category;
        await fetchAndShow(url, 'movies');
        document.getElementById('search').value='';
    }

    async function showMoViesByTitleAndCategory() {
        let movieTitle = document.getElementById('search').value
        let url = window.location.origin + '/movies-by-title-and-category/' + movieTitle + '/' + lastSelectedCategory;
        await fetchAndShow(url, 'movies');
    }
</script>

</body>
</html>

