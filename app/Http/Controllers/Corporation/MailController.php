<?php

namespace App\Http\Controllers\Corporation;

use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MailController extends Controller
{
    /**
     * Fetch EVEmail from the ESI and add it to the cache...
     * ...because fetching mail takes a loooooong time.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if (Cache::has('evemail:' . $this->esi->id)) {
            $evemail = Cache::get('evemail:' . $this->esi->id);
        } else {
            $evemail = $this->esi->fetch('/characters/' . $this->esi->id . '/mail');
            foreach ($evemail as $mail)
            {
                $mail->from = $this->esi->fetch('/characters/' . $mail->from)->name ?? $mail->from;

                $mail->to = $this->esi->fetch('/characters/' . $mail->recipients[0]->recipient_id)->name
                    ?? $mail->recipients[0]->recipient_id;

                $mail->is_read = $mail->is_read ?? false;
            }

            Cache::put('evemail:' . $this->esi->id, $evemail, 1300);
        }

        $emails = [];
        foreach ($evemail as $mail)
        {
            if ($mail->from === $this->esi->name) {
                $emails['sent'][] = $mail;
            } else {
                $emails['received'][] = $mail;
            }
        }

        return view('management.mailbox', compact('emails'));
    }

    /**
     * View EVEMail.
     *
     * @param string $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function view(string $id)
    {
        $mail = $this->esi->fetch('/characters/' . $this->esi->id . '/mail/' . $id);

        if (! $mail) {
            return redirect()->back();
        }

        $mail->from = $this->esi->fetch('/characters/' . $mail->from)->name ?? $mail->from;

        $mail->to = $this->esi->fetch('/characters/' . $mail->recipients[0]->recipient_id)->name
            ?? $mail->recipients[0]->recipient_id;

        return view('management.mail', compact('mail'));
    }
}
