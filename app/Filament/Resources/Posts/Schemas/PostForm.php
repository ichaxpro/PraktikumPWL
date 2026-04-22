<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Fields')
                    ->description('Main post content and attributes')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Group::make([
                            TextInput::make('title')
                                ->rules('required , min:3 , max:10'),
                                // ->minLength(5)
                                // ->maxLength(255),
                            TextInput::make('slug')
                                ->rules('required')
                                ->unique(ignoreRecord: true)
                                ->validationMessages([
                                  'unique' => 'Slug must be unique',
                                ]),
                            Select::make('category_id')
                                ->relationship('category', 'name')
                                ->required()
                                ->preload()
                                ->searchable(),
                            ColorPicker::make('color'),
                        ])->columns(2),
                        MarkdownEditor::make('content'),
                        FileUpload::make('image')
                            ->required()
                            ->disk('public')
                            ->directory('posts'),
                    ])
                    ->columnSpan(2),

                Section::make('Meta')
                    ->description('Publishing and metadata')
                    ->icon('heroicon-o-adjustments-horizontal')
                    ->schema([
                        TagsInput::make('tags'),
                        Checkbox::make('published'),
                        DateTimePicker::make('published_at'),
                    ])
                    ->columnSpan(1),

            ])->columns(3);
    }
}
