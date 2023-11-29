<?php

namespace Mokhosh\FilamentKanban\Concerns;

use Filament\Forms\Form;

trait HasEditRecordModal
{
    public array $editModalFormState = [];

    public ?int $editModalRecordId = null;

    protected string $editModalTitle = 'Edit Record';

    protected string $editModalWidth = '2xl';

    protected string $editModalSaveButtonLabel = "Save";

    protected string $editModalCancelButtonLabel = "Cancel";

    public function recordClicked($recordId, $data): void
    {
        $this->editModalRecordId = $recordId;

        $this->form->fill($this->getEditModalRecordData($recordId, $data));

        $this->dispatch('open-modal', id: 'kanban--edit-modal-form');
    }

    public function getEditModalRecordData($recordId, $data): array
    {
        return $data;
    }

    protected function getEditModalTitle(): string
    {
        return $this->editModalTitle;
    }

    protected function getEditModalWidth(): string
    {
        return $this->editModalWidth;
    }

    protected function getEditModalSaveButtonLabel(): string
    {
        return $this->editModalSaveButtonLabel;
    }

    protected function getEditModalCancelButtonLabel(): string
    {
        return $this->editModalCancelButtonLabel;
    }

    public function onEditModalFormSubmit(): void
    {
        $this->editRecord($this->editModalRecordId, $this->form->getState(), $this->editModalFormState);

        $this->editModalRecordId = null;

        $this->dispatch('close-modal', id: 'kanban--edit-modal-form');
    }

    public function editRecord($recordId, array $data, array $state): void
    {
        // Override this function and do whatever you want with $data
    }

    protected function getEditModalFormSchema(int|null $recordId): array
    {
        return [];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema($this->getEditModalFormSchema($this->editModalRecordId))
            ->statePath('editModalFormState');
    }
}