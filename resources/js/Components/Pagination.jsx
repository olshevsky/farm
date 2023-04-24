import React from 'react';

export default function Pagination({ links, className }) {
    return (
        <ul className={`flex justify-center space-x-2 ` + className}>
            {links.map((link) => (
                <li key={link.label}>
                    <a
                        href={link.url}
                        dangerouslySetInnerHTML={{ __html: link.label }}
                        className={`inline-block px-3 py-1 rounded-lg ${
                            link.active
                                ? 'bg-blue-500 text-white'
                                : 'bg-white border border-gray-300 text-gray-500'
                        }`}
                    ></a>
                </li>
            ))}
        </ul>
    );
}
