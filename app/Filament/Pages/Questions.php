<?php

namespace App\Filament\Pages;

use App\Models\Question;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class Questions extends Page implements HasTable
{
    use interactsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.questions';


    public function table(Table $table): Table
    {
        return $table
            ->query(Question::query())
            ->columns([
                TextColumn::make('user.name')->label('Sender User'),
                TextColumn::make('body')->label('Question'),
                TextColumn::make('answer')->label('Answer'),
                IconColumn::make('is_answered')->label('Answered')->boolean(),
                TextColumn::make('answeringuser.name')->label('Answering User'),
            ])
            ->
            filters([
                // ...
            ])
            ->actions([
                Action::make('Answer')
                    ->fillForm(fn(Question $question) => $question->toArray())
                    ->record(fn(Question $question) => $question)
                    ->form([
                        TextInput::make('answer')
                            ->required()
                            ->maxLength(255),
                    ])->action(function (array $data, Question $question): void {
                        $data['is_answered'] = true;
                        $data['answered_by'] = auth()->id();
                        $question->update($data);
                        Notification::make()
                            ->title('Question Answered')
                            ->success()
                            ->send();
                    })->disabled(fn(Question $question) => $question->is_answered),
            ])
            ->bulkActions([
                // ...
            ]);
    }
}
