import { React, useState } from 'react';
import Authenticated from '@/Layouts/Authenticated';
import { Head, useForm, usePage, Link } from '@inertiajs/inertia-react';

export default function FarmEdit(props) {

    const { farm, animals, selected } = usePage().props;
    const [selectedAnimals, setSelectedAnimals] = useState(selected);

    const { data, setData, put, errors } = useForm({
        name: farm.name || "",
        email: farm.email || "",
        website: farm.website || "",
        animals: [...selected]
    });

    const handleAnimalChange = (event) => {
        const selectedOptions = Array.from(event.target.selectedOptions, (option) => option.value);
        if (selectedOptions.length <= 3) {
            setSelectedAnimals(selectedOptions);
            data.animals = selectedOptions;
        }
    };

    function handleSubmit(e) {
        e.preventDefault();
        put(route("farms.update", farm.id));
    }

    return (
        <Authenticated
            auth={props.auth}
            errors={props.errors}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Edit Farms</h2>}
        >
            <Head title="Farms" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 bg-white border-b border-gray-200">
                            <div className="flex items-center justify-between mb-6">
                                <Link
                                    className="px-6 py-2 text-white bg-blue-500 rounded-md focus:outline-none"
                                    href={ route("farms.index") }
                                >
                                    Back
                                </Link>
                            </div>
                            <form name="createForm" onSubmit={handleSubmit}>
                                <div className="flex flex-col">
                                    <div className="flex flex-col">
                                        <div className="mb-4">
                                            <label className="">Name</label>
                                            <input
                                                type="text"
                                                className="w-full px-4 py-2"
                                                label="Name"
                                                name="name"
                                                value={data.name}
                                                onChange={(e) =>
                                                    setData("name", e.target.value)
                                                }
                                            />
                                            <span className="text-red-600">
                                                {errors.name}
                                            </span>
                                        </div>
                                        <div className="mb-4">
                                            <label className="">Email</label>
                                            <input
                                                type="text"
                                                className="w-full px-4 py-2"
                                                label="Email"
                                                name="email"
                                                value={data.email}
                                                onChange={(e) =>
                                                    setData("email", e.target.value)
                                                }
                                            />
                                            <span className="text-red-600">
                                                {errors.email}
                                            </span>
                                        </div>
                                        <div className="mb-4">
                                            <label className="">Website</label>
                                            <input
                                                type="text"
                                                className="w-full px-4 py-2"
                                                label="Website"
                                                name="website"
                                                value={data.website}
                                                onChange={(e) =>
                                                    setData("website", e.target.value)
                                                }
                                            />
                                            <span className="text-red-600">
                                                {errors.website}
                                            </span>
                                        </div>
                                        <div className="mb-4">
                                            <label className="">Animals</label>
                                            <select
                                                name="animals"
                                                multiple
                                                value={selectedAnimals}
                                                onChange={handleAnimalChange}
                                                className="mt-1 block w-full pl-3 pr-10 py-2 text-base focus:outline-none"
                                            >
                                                {animals.map((animal) => (
                                                    <option key={animal.id} value={animal.id}>
                                                        { `${animal.type} ${animal.number} (${animal.years})` }
                                                    </option>
                                                ))}
                                            </select>
                                            <span className="text-red-600">
                                                {errors.animals}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div className="mt-4">
                                    <button type="submit" className="px-6 py-2 font-bold text-white bg-green-500 rounded">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </Authenticated>
    );
}
