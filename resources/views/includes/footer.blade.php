<footer class="main-footer">
    <span>{{ Carbon\Carbon::now()->format('h:i A') }}</span>
    <div class="float-right d-none d-sm-inline-block">
      {{ Carbon\Carbon::now()->format('d/m/Y') }}
    </div>
</footer>
