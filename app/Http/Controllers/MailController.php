<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
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
        $this->esi->setURL(config('eve.esi.api_uri'));

        $character = Session::get('character');
        if (Cache::has('evemail:' . $character['id'])) {
            $evemail = Cache::get('evemail:' . $character['id']);
        } else {
            $evemail = $this->esi->fetch('/characters/' . $character['id'] . '/mail', 'GET', true);
            foreach ($evemail as $mail)
            {
                $mail->from = $this->esi->fetch('/characters/' . $mail->from, 'GET', true)->name ?? $mail->from;

                $mail->to = $this->esi->fetch('/characters/' . $mail->recipients[0]->recipient_id, 'GET', true)->name
                    ?? $mail->recipients[0]->recipient_id;

                $mail->is_read = $mail->is_read ?? false;
            }

            Cache::put('evemail:' . $character['id'], $evemail, 1300);
        }

        $emails = [];
        foreach ($evemail as $mail)
        {
            if ($mail->from === $character['name']) {
                $emails['sent'][] = $mail;
            } else {
                $emails['received'][] = $mail;
            }
        }

        return view('mail.mailbox', compact('emails'));
    }

    /**
     * View EVEMail.
     *
     * @param string $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function view(string $id)
    {
        $this->esi->setURL(config('eve.esi.api_uri'));

        $character = Session::get('character');
        $mail = $this->esi->fetch('/characters/' . $character['id'] . '/mail/' . $id);

        if (! $mail) {
            return redirect()->back();
        }

        $mail->from = $this->esi->fetch('/characters/' . $mail->from)->name ?? $mail->from;

        $mail->to = $this->esi->fetch('/characters/' . $mail->recipients[0]->recipient_id)->name
            ?? $mail->recipients[0]->recipient_id;

        return view('mail.mail', compact('mail'));
    }
}
