<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RfidListener extends Component
{
    public $epc;

    protected $listeners = ['echo:rfid-channel,tag.scanned' => 'handleTagScanned'];

    public function handleTagScanned($data)
    {
        $this->epc = $data['tagData'];
        
        // Emit event ke Filament form
        $this->dispatchBrowserEvent('rfid-update', $data['tagData']);
    }

    public function render()
    {
        return view('livewire.rfid-listener');
    }
}