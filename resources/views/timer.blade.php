<x-app-layout>
<x-slot name="header"><h2 class="sf-title">Cronômetro de estudos</h2><p class="sf-subtitle mb-0">Use o foco por ciclos e acompanhe seu tempo.</p></x-slot>
<div class="row justify-content-center"><div class="col-md-7"><div class="sf-card text-center">
<div class="mb-4"><label for="minutes">Minutos</label><input id="minutes" type="number" min="1" max="180" value="25" class="form-control mx-auto" style="max-width:140px;text-align:center"></div>
<div id="timer-display" style="font-size:72px;font-weight:700;color:#464649;letter-spacing:3px">25:00</div>
<p id="timer-status" class="text-muted">Pronto para começar</p>
<div class="d-flex justify-content-center flex-wrap" style="gap:10px">
<button id="start" class="sf-btn">Iniciar</button><button id="pause" class="sf-btn-outline">Pausar</button><button id="reset" class="btn btn-outline-secondary" style="border-radius:24px">Reiniciar</button>
</div>
</div></div></div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded',()=>{
 let total=25*60, remaining=total, interval=null, running=false;
 const display=document.getElementById('timer-display'), input=document.getElementById('minutes'), status=document.getElementById('timer-status');
 const render=()=>{const m=Math.floor(remaining/60),s=remaining%60;display.textContent=String(m).padStart(2,'0')+':'+String(s).padStart(2,'0');};
 input.addEventListener('change',()=>{if(!running){let v=Math.max(1,Math.min(180,parseInt(input.value)||25));input.value=v;total=remaining=v*60;status.textContent='Pronto para começar';render();}});
 document.getElementById('start').onclick=()=>{if(running)return; if(remaining<=0) remaining=total; running=true; status.textContent='Foco! Cronômetro em andamento.'; interval=setInterval(()=>{remaining--;render();if(remaining<=0){clearInterval(interval);interval=null;running=false;status.textContent='Tempo concluído! 🎉'; alert('Tempo de estudo concluído!');}},1000);};
 document.getElementById('pause').onclick=()=>{if(interval){clearInterval(interval);interval=null;}running=false;status.textContent='Pausado';};
 document.getElementById('reset').onclick=()=>{if(interval)clearInterval(interval);interval=null;running=false;total=(Math.max(1,Math.min(180,parseInt(input.value)||25)))*60;remaining=total;status.textContent='Pronto para começar';render();};
 render();
});
</script>
@endpush
</x-app-layout>