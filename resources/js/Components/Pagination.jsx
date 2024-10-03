import { Link } from "@inertiajs/react";

export default function Pagination ({links}) {
    return (
        <nav className="text-center mt-4">
            {links.map(link => (
                <Link 
                preserveScroll
                href={link.url || ""}
                key={link.label}
                className={"inline-block py-2 px-3 rounded-lg text-gray-200 text-xs " +
                    (link.active ? "bg-gray-950 " : " ") + 
                    (!link.url ? "!text-gray-500 cursor-not-allowed " : "hover:bg-gray-950")
                }
                dangerouslySetInnerHTML={{__html: link.label}}></Link>
            ))}
        </nav>
    )
}

// import { Link } from "@inertiajs/react";

// export default function Pagination({ links }) {
//     return (
//         <nav className="flex justify-center mt-4">
//             <ul className="flex flex-wrap items-center space-x-1">
//                 {links.map((link, index) => (
//                     <li key={index} className="mb-1">
//                         <Link
//                             href={link.url || ""}
//                             className={`py-2 px-3 rounded-lg text-xs ${
//                                 link.active
//                                     ? "bg-gray-950 text-white"
//                                     : "bg-gray-200 text-gray-700 hover:bg-gray-300"
//                             } ${!link.url ? "text-gray-500 cursor-not-allowed" : ""}`}
//                             dangerouslySetInnerHTML={{ __html: link.label }}
//                         ></Link>
//                     </li>
//                 ))}
//             </ul>
//         </nav>
//     );
// }
