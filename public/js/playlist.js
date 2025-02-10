const songs = document.querySelectorAll('.playlist-song');
        const currentSong = document.getElementById('current-song');
        const footer = document.querySelector('footer');
        const recommended = document.getElementById('recommended');

        fetch('/mostrar/playlist').then(response => response.json()).then(playlists => {
            playlists.forEach(playlist => {
                const img = document.createElement('img');
                img.src = 'images/cover.png';

                const songDiv = document.createElement('div');
                songDiv.classList.add('playlist-song');

                const songNameDiv = document.createElement('div');
                const songName = document.createElement('p');
                songName.classList.add('playlist-name');
                songName.textContent = playlist.nombre;

                songNameDiv.appendChild(songName);
                songNameDiv.classList.add('current-song-detail');

                songDiv.appendChild(img);
                songDiv.appendChild(songNameDiv);

                songDiv.addEventListener('click', () => {
                    footer.style.visibility = 'visible';
                    currentSong.innerHTML = '';
                    const songTitle = songDiv.querySelector('.playlist-name').textContent;
                    const p = document.createElement('p');
                    p.textContent = songTitle;
                    currentSong.appendChild(p);

                    const audio = document.querySelector('audio');
                    audio.src = `playlist/${playlist.id}`;
                    audio.play();
                });

                recommended.appendChild(songDiv);
            });
        });