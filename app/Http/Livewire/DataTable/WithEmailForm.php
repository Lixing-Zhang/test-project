<?php

namespace App\Http\Livewire\DataTable;

use Illuminate\Database\Eloquent\Model;

trait WithEmailForm
{

    public string $subject = 'Quote [Quote Number] from [Trading Name] for [Customer Name]';
    public string $content = "Hi [Customer Name],

Thank you for your enquiry.

Here's quote [Quote Number] for [Currency Code] [Quote Total Without Currency].

View your quote online: [Online Quote Link]

From your online quote you can accept or print.

If you have any questions, please let us know.

Thanks,
[Trading Name]
[Staff Email]
[Contact Number]

Terms
[Terms]";

    public function emailForm()
    {
        $this->showEmailModal = true;
    }

    public function sendEmail()
    {
        $this->emitTo('email-form', 'sendEmail', [
            'objectClass' => $this->objectClass(),
            'objectId' => $this->objectId(),
            'template' => $this->emailTemplate(),
            'search' => $this->searchData(),
            'replace' => $this->replaceData(),
            'fromName' => $this->fromName(),
        ]);
    }

    private function canSendEmail(): bool
    {
        return count($this->selected) == 1;
    }

    abstract public function objectClass(): string;
    abstract public function objectId(): string;
    abstract public function fromName(): string;
    abstract public function emailTemplate(): string;
    abstract protected function searchData(): array;
    abstract protected function replaceData(): array;
}
