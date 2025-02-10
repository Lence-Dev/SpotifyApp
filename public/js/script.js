const canciones = document.querySelectorAll('.song');
const currentSong = document.getElementById('current-song');
const footer = document.querySelector('footer');
const recommended = document.getElementById('recommended');

fetch('/mostrar/canciones').then(response => response.json()).then(canciones => {
    canciones.forEach(cancion => {
        const img = document.createElement('img');
        img.src = cancion.foto ? cancion.foto : 'images/cover.png';

        const songDiv = document.createElement('div');
        songDiv.classList.add('song');

        songDiv.addEventListener('click', () => {
            footer.style.visibility = 'visible';
            currentSong.innerHTML = '';
            const songName = songDiv.querySelector('.song-name').textContent;
            const p = document.createElement('p');
            p.textContent = `${songName} - ${cancion.autor}`;
            currentSong.appendChild(p);

            const audio = document.querySelector('audio');
            audio.src = `cancion/${cancion.id}`;
            audio.play();
        });

        const songNameDiv = document.createElement('div');
        const songName = document.createElement('p');
        songName.classList.add('song-name');
        songName.textContent = cancion.titulo;

        songNameDiv.appendChild(songName);
        songNameDiv.classList.add('current-song-detail');

        songDiv.appendChild(img);
        songDiv.appendChild(songNameDiv);

        recommended.appendChild(songDiv);
    });
});