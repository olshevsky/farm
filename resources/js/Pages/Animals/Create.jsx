import React from 'react';
import Authenticated from '@/Layouts/Authenticated';
import { Head, useForm, Link } from '@inertiajs/inertia-react';

export default function AnimalCreate(props) {

    const { data, setData, errors, post } = useForm({
        number: "",
        type: "",
        years: ""
    });

    function handleSubmit(e) {
        e.preventDefault();
        post(route("animals.store"));
    }

    return (
        <Authenticated
            auth={props.auth}
            errors={props.errors}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Create Animal</h2>}
        >
            <Head title="Animals" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 bg-white border-b border-gray-200">

                            <div className="flex items-center justify-between mb-6">
                                <Link
                                    className="px-6 py-2 text-white bg-blue-500 rounded-md focus:outline-none"
                                    href={ route("animals.index") }
                                >
                                    Back
                                </Link>
                            </div>

                            <form name="createForm" onSubmit={handleSubmit}>
                                <div className="flex flex-col">
                                    <div className="mb-4">
                                        <label className="">Number</label>
                                        <input
                                            type="text"
                                            className="w-full px-4 py-2"
                                            label="Number"
                                            name="number"
                                            value={data.number}
                                            onChange={(e) =>
                                                setData("number", e.target.value)
                                            }
                                        />
                                        <span className="text-red-600">
                                            {errors.number}
                                        </span>
                                    </div>
                                    <div className="mb-4">
                                        <label className="">Type name</label>
                                        <input
                                            type="text"
                                            className="w-full px-4 py-2"
                                            label="Type name"
                                            name="type"
                                            value={data.type}
                                            onChange={(e) =>
                                                setData("type", e.target.value)
                                            }
                                        />
                                        <span className="text-red-600">
                                            {errors.type}
                                        </span>
                                    </div>
                                    <div className="mb-4">
                                        <label className="">Years</label>
                                        <input
                                            type="text"
                                            className="w-full px-4 py-2"
                                            label="Years"
                                            name="years"
                                            value={data.years}
                                            onChange={(e) =>
                                                setData("years", e.target.value)
                                            }
                                        />
                                        <span className="text-red-600">
                                            {errors.years}
                                        </span>
                                    </div>
                                </div>
                                <div className="mt-4">
                                    <button type="submit" className="px-6 py-2 font-bold text-white bg-green-500 rounded">Save</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </Authenticated>
    );
}
