<div wire:ignore>
    <!-- Div kosong karena kita hanya butuh JavaScript-nya -->
    <script>
        document.addEventListener('livewire:load', function() {
            window.Echo.channel('rfid-channel')
                .listen('.tag.scanned', (data) => {
                    window.Livewire.emit('echo:rfid-channel,tag.scanned', data);
                });
        });
    </script>
</div>