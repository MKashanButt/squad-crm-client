<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\CenterCode;
use App\Models\FormInput;
use App\Models\Insurance;
use App\Models\Products;
use App\Models\Users;

class FormInputFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FormInput::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'patient_phone' => $this->faker->regexify('[A-Za-z0-9]{15}'),
            'secondary_phone' => $this->faker->regexify('[A-Za-z0-9]{15}'),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'dob' => $this->faker->date(),
            'medicare_id' => $this->faker->regexify('[A-Za-z0-9]{15}'),
            'address' => $this->faker->text(),
            'city' => $this->faker->city(),
            'state' => $this->faker->regexify('[A-Za-z0-9]{15}'),
            'zip' => $this->faker->postcode(),
            'product_specs' => $this->faker->text(),
            'doctor_name' => $this->faker->regexify('[A-Za-z0-9]{30}'),
            'facility_name' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'patient_last_visit' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'doctor_address' => $this->faker->text(),
            'doctor_phone' => $this->faker->regexify('[A-Za-z0-9]{15}'),
            'doctor_fax' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'doctor_npi' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'recording_link' => $this->faker->text(),
            'comments' => $this->faker->text(),
            'status' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'center_code_id' => CenterCode::factory(),
            'insurance_id' => Insurance::factory(),
            'products_id' => Products::factory(),
            'users_id' => Users::factory(),
        ];
    }
}
