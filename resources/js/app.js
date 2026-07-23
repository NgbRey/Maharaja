import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


document.addEventListener('DOMContentLoaded', () => {
  const track = document.getElementById('slides');
  if (!track) return;

  const dots = Array.from(document.querySelectorAll('#indicators span'));
  const total = track.children.length;
  let index = 0, timer;

  function show(i){
    index = (i + total) % total;
    track.style.transform = `translateX(-${index * 100}%)`;
    dots.forEach((d,k)=>d.classList.toggle('bg-white', k===index));
    dots.forEach((d,k)=>d.classList.toggle('bg-white/50', k!==index));
  }
  function next(){ show(index + 1); }
  function prev(){ show(index - 1); }
  function start(){ if (total > 1) timer = setInterval(next, 5000); }
  function stop(){ clearInterval(timer); }

  const nextBtn = document.getElementById('nextBtn');
  const prevBtn = document.getElementById('prevBtn');

  nextBtn && (nextBtn.onclick = () => { stop(); next(); start(); });
  prevBtn && (prevBtn.onclick = () => { stop(); prev(); start(); });
  dots.forEach(d => d.onclick = () => { stop(); show(+d.dataset.i); start(); });

  show(0); start();
});


