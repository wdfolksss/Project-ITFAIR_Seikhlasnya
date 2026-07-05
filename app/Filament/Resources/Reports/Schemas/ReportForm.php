<?php

namespace App\Filament\Resources\Reports\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\HtmlString;

class ReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Data Laporan Masyarakat')
                    ->description('Informasi utama laporan yang dikirim oleh masyarakat.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('reporter_name')
                                    ->label('Nama Pelapor')
                                    ->disabled(),

                                TextInput::make('contact')
                                    ->label('No. HP / Email')
                                    ->disabled(),

                                Select::make('category_id')
                                    ->label('Kategori Kerusakan')
                                    ->relationship('category', 'name')
                                    ->required(),

                                Select::make('severity')
                                    ->label('Tingkat Kerusakan')
                                    ->options([
                                        'ringan' => 'Ringan',
                                        'sedang' => 'Sedang',
                                        'berat' => 'Berat',
                                    ])
                                    ->required(),

                                TextInput::make('latitude')
                                    ->label('Latitude')
                                    ->disabled(),

                                TextInput::make('longitude')
                                    ->label('Longitude')
                                    ->disabled(),
                            ]),

                        Textarea::make('address')
                            ->label('Alamat Detail')
                            ->rows(2)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Deskripsi / Detail Lokasi')
                            ->rows(4)
                            ->columnSpanFull(),

                        FileUpload::make('image')
                            ->label('Dokumentasi Laporan')
                            ->image()
                            ->disk('public')
                            ->directory('reports')
                            ->columnSpanFull(),
                    ]),

                Section::make('Penanganan Admin')
                    ->description('Kelola status dan berikan tanggapan kepada masyarakat.')
                    ->schema([
                        Select::make('status_id')
                            ->label('Status Laporan')
                            ->relationship('status', 'name')
                            ->required(),

                        Textarea::make('admin_response')
                            ->label('Tanggapan Admin')
                            ->placeholder('Contoh: Terima kasih sudah melapor. Laporan akan segera kami tindaklanjuti.')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

            ]);
    }
}