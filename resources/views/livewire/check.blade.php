<div>

    <div style="text-align: center">
        <button class="btn btn-warning" wire:click="button">asd</button>
        <button onclick="play()">Play Audio</button>
    </div>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
            function play() {
                new Audio('{{ asset('pesan.m4a') }}').play();
            }

            var pusher = new Pusher('f4851f400c2b4a770a38', {
                cluster: 'ap1'
            });

            var channel = pusher.subscribe('orders');

            channel.bind('order-event', function (data) {
                alert("asdasda")
            });


    </script>
</div>
