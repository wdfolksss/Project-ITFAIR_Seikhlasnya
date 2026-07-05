<?php

namespace App\Filament\Resources\Reports\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\HtmlString;


class ReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('reporter_name')
                    ->label('Nama Pelapor')
                    ->required(),
                TextInput::make('contact')
                    ->label('Kontak')
                    ->required(),
                Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->required(),
                Textarea::make('address')
                    ->label('Alamat')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('latitude')
                    ->required()
                    ->numeric(),
                TextInput::make('longitude')
                    ->required()
                    ->numeric(),
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->columnSpanFull(),
                Placeholder::make('map')
                    ->label('Lokasi Laporan')
                    ->content(function ($record) {
                        
                        if (! $record?->latitude || ! $record?->longitude) {
                            return 'Lokasi tidak tersedia';
                        }
                        
                        return new HtmlString("
                        <iframe
                        width='100%'
                        height='400'
                        style='border:0;border-radius:12px'
                        loading='lazy'
                        allowfullscreen
                        src='https://maps.google.com/maps?q={$record->latitude},{$record->longitude}&z=15&output=embed'>
                        </iframe>
                        ");
                    })
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('Foto Laporan')
                    ->image()
                    ->disk('public')
                    ->directory('reports')
                    ->required()
                    ->columnSpanFull(),
                Select::make('severity')
                    ->label('Prioritas')
                    ->options(['ringan' => 'Ringan', 'sedang' => 'Sedang', 'berat' => 'Berat'])
                    ->required(),
                Select::make('status_id')
                    ->label('Status')
                    ->relationship('status', 'name')
                    ->required(),
                Textarea::make('admin_response')
                    ->label('Tanggapan Admin')
                    ->rows(4)
                    ->columnSpanFull()
                    ->dehydrated(true),
            ]);
    }
}
