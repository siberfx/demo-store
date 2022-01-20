<?php

namespace Database\Seeders;

use GetCandy\FieldTypes\Text;
use GetCandy\FieldTypes\TranslatedText;
use GetCandy\Models\Collection;
use GetCandy\Models\CollectionGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollectionSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collections = $this->getSeedData('collections');

        DB::transaction(function () use ($collections) {
            foreach ($collections as $collection) {
                Collection::create([
                    'collection_group_id' => CollectionGroup::first()->id,
                    'attribute_data' =>  [
                        'name' => new TranslatedText([
                            'en' => new Text($collection->name)
                        ]),
                    ]
                ]);
            }
        });
    }
}
