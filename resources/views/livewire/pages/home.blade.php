<div>
    <div>
        {{$count}} -
        Hello World
    </div>
    <div>
        <button wire:click="increment">+</button>
        <button wire:click="decrement">-</button>
    </div>
    <div>
        <input type="number" wire:model.debounce.500ms="myVal" />
    </div>
    <h1>
        {{ $user ? $user->name : 'No User Found' }}
    </h1>

</div>
