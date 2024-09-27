<?php

namespace App\Listeners;

use App\Events\SkrdCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\WaService;
use App\Entity\Master\ObjekRetribusi;
use App\Entity\User\Pemakai;

class SendWhatsapp
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SkrdCreated  $event
     * @return void
     */
    public function handle(SkrdCreated $event)
    {
        $pemakai = $this->getPemakai($event->skrd->pemakai_id);

        if($pemakai->no_telp) {
            $nomor_skrd = $event->skrd->format_nomor;
            $phone = $this->phoneParse($pemakai->no_telp);
            $objectRetribusi = $this->getObjectRetribusiById($event->skrd->object_retribusi_id);

            $wa = new WaService;
            $wa->kirim(sprintf('SKRD BKAD Kota Malang segera Lakukan  Pembayaran %s %s %s %s Rp %s',
                                $nomor_skrd,
                                $this->dateParse($event->skrd->tanggal)->format('d M Y'),
                                $pemakai->nama,
                                $objectRetribusi->lokasi,
                                format_idr((string) $event->skrd->nominal)
                            ), $phone);

        }

    }

    private function getPemakai($id)
    {
        return Pemakai::find($id);
    }

    private function dateParse($date)
    {
        return \Carbon\Carbon::parse($date);
    }

    private function phoneParse($phone)
    {
        if($phone[0] == '0') {
            $phone = substr($phone, 1);
            $phone = '62' . $phone;

        }
        return $phone;
    }

    private function getObjectRetribusiById($id)
    {
        $objectRetribusi = ObjekRetribusi::find($id);

        return $objectRetribusi;
    }
}
