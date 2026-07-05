<?php

namespace App\Filament\Resources\Reports\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class ReportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Foto')
                    ->disk('public')
                    ->square()
                    ->size(64),

                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('severity')
                    ->label('Kerusakan')
                    ->badge()
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->color(fn ($state) => match ($state) {
                        'ringan' => 'success',
                        'sedang' => 'warning',
                        'berat' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('status.name')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'Pending' => 'warning',
                        'Diverifikasi' => 'info',
                        'Diproses' => 'primary',
                        'Selesai' => 'success',
                        default => 'gray',
                    }),

                TextColumn::make('address')
                    ->label('Lokasi')
                    ->limit(35)
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()
                    ->label('Kelola')
                    ->icon('heroicon-o-pencil-square'),

                DeleteAction::make()
                    ->label('Hapus'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50]);
    }
}