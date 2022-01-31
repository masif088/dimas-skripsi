<form wire:submit.prevent="update">
    <x-form.input type="number" model="amount" title="Jumlah sekarang (sebelumnya: {{$stockGood->amount}})"/>
    <x-form.textarea model="note" title="Catatan perubahan"/>
    <button type="submit" class="btn btn-primary float-end">Submit</button>
</form>

