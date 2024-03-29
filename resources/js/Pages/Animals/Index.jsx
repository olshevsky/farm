import React from 'react';
import Authenticated from '@/Layouts/Authenticated';
import Pagination from "@/Components/Pagination";
import { Inertia } from "@inertiajs/inertia";
import { Head, usePage, Link } from '@inertiajs/inertia-react';

export default function AnimalIndex(props) {
    const { animals } = usePage().props

    function destroy(e) {
        if (confirm("Are you sure you want to delete this animal?")) {
            Inertia.delete(route("animals.destroy", e.currentTarget.id));
        }
    }

    return (
        <Authenticated
            auth={props.auth}
            errors={props.errors}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Animals</h2>}
        >
            <Head title="Animals" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 bg-white border-b border-gray-200">

                            <div className="flex items-center justify-between mb-6">
                                <Link
                                    className="px-6 py-2 text-white bg-green-500 rounded-md focus:outline-none"
                                    href={ route("animals.create") }
                                >
                                    Create Animal
                                </Link>
                            </div>

                            <table className="table-fixed w-full">
                                <thead>
                                    <tr className="bg-gray-100">
                                        <th className="px-4 py-2 w-20">Id</th>
                                        <th className="px-4 py-2">Number</th>
                                        <th className="px-4 py-2">Type name</th>
                                        <th className="px-4 py-2">Years</th>
                                        <th className="px-4 py-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {animals.data.map(({ id, number, type, years }) => (
                                        <tr key={id}>
                                            <td className="border px-4 py-2">{ id }</td>
                                            <td className="border px-4 py-2">{ number }</td>
                                            <td className="border px-4 py-2">{ type }</td>
                                            <td className="border px-4 py-2">{ years }</td>
                                            <td className="border px-4 py-2">
                                                <Link
                                                    tabIndex="1"
                                                    className="px-4 py-2 text-sm text-white bg-blue-500 rounded"
                                                    href={route("animals.edit", id)}
                                                >
                                                    Edit
                                                </Link>
                                                <button
                                                    onClick={destroy}
                                                    id={id}
                                                    tabIndex="-1"
                                                    type="button"
                                                    className="mx-1 px-4 py-2 text-sm text-white bg-red-500 rounded"
                                                >
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    ))}

                                    { animals.length === 0 && (
                                        <tr>
                                            <td className="px-6 py-4 border-t" colSpan="4">
                                                No animals found.
                                            </td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                            <Pagination links={animals.links} className={'mt-4'}></Pagination>
                        </div>
                    </div>
                </div>
            </div>
        </Authenticated>
    );
}
