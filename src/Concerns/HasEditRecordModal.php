<?php

namespace Rafazingano\FilamentKanban\Concerns;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

trait HasEditRecordModal
{
    public bool $disableEditModal = false;

    public ?array $editModalFormState = [];

    public $editModalRecordId = null;

    protected string $editModalTitle = 'Edit Record';

    protected string $editModalWidth = '2xl';

    protected string $editModalSaveButtonLabel = 'Save';

    protected string $editModalCancelButtonLabel = 'Cancel';

    public function mount(): void
    {
        $this->form->fill();
    }

    public function recordClicked($recordId, array $data): void
    {
        $this->editModalRecordId = $recordId;

        /**
         * todo - the following line is a hacky fix
         * figure why sometimes form schema is created before this
         * method when a RichText is present in the form schema
         **/
        $this->form($this->form);
        $this->form->fill($this->getEditModalRecordData($recordId, $data));

        $this->dispatch('open-modal', id: 'kanban--edit-record-modal');
    }

    public function editModalFormSubmitted(): void
    {
        $this->editRecord($this->editModalRecordId, $this->form->getState(), $this->editModalFormState);

        $this->editModalRecordId = null;
        $this->form->fill();

        $this->dispatch('close-modal', id: 'kanban--edit-record-modal');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema($this->getEditModalFormSchema($this->editModalRecordId))
            ->statePath('editModalFormState')
            ->model($this->editModalRecordId ? static::$model::find($this->editModalRecordId) : static::$model);
    }

    protected function getEditModalRecordData($recordId, array $data): array
    {
        return $this->getEloquentQuery()->find($recordId)->toArray();
    }

    protected function editRecord($recordId, array $data, array $state): void
    {
        $this->getEloquentQuery()->find($recordId)->update($data);
    }

    protected function getEditModalFormSchema($recordId): array
    {
        return [
            TextInput::make(static::$recordTitleAttribute),
        ];
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
}
