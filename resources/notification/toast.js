import { baseUrl } from "../js/utils/baseUrl.js";
import { markAsViewed } from "./utils/markAsViewed.js";

const createContainer = (tagName, ...classNames) => {
    const element = document.createElement(tagName);

    element.classList.add(...classNames);

    return element;
};

const handleViewed = () => {
    const notificationCount = document.querySelector(".notification-count");

    let total = Number.parseInt(notificationCount.textContent);

    if (total === 0) return;

    notificationCount.textContent = total - 1;
};

const createCloseButton = (toastItem) => {
    const button = document.createElement("button");

    button.classList.add("toast-close-button");

    button.setAttribute("aria-label", "Fechar notificação");

    button.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>`;

    const handleClick = async (event) => {
        event.preventDefault();
        event.stopPropagation();

        button.disabled = true;

        try {
            await markAsViewed(toastItem.id);

            // atualiza a contagem de notificação no badge do painel
            handleViewed();

            button.removeEventListener("click", handleClick);

            toastItem.remove();
        } catch (err) {
            console.log(err);
        } finally {
            button.disabled = false;
        }
    };

    button.addEventListener("click", handleClick);

    return button;
};

const createToastItem = ({
    id,
    uuid,
    title,
    recipient_id,
    created_by,
    created_at,
}) => {
    const toastItem = document.createElement("li");

    toastItem.classList.add("toast-item");

    toastItem.setAttribute("id", id);
    toastItem.setAttribute("role", "alert");
    toastItem.setAttribute("aria-live", "assertive");

    toastItem.innerHTML = `
        <header class="toast-item-header">
            <div class="toast-item-header-container">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                </svg>
                <h3>${title}</h3>
            </div>
            <p>Enviado por <strong>${created_by}</strong> em ${created_at}</p>
        </header>
        <footer>
            <a href="${baseUrl}/recipient/${recipient_id}/${uuid}" target="_blank" rel="noopener noreferrer" class="toast-action-button">
                Visualizar Notificação
            </a>
        </footer>
    `;

    toastItem.append(createCloseButton(toastItem));

    return toastItem;
};

const createToastFragment = (items) => {
    const fragment = document.createDocumentFragment();

    fragment.append(...items.map(createToastItem));

    return fragment;
};

export const initToast = async ({ body, notifications }) => {
    const storeId = body.storeId;

    if (!storeId) {
        console.log(
            "O atributo [data-store] não está definido no elemento body"
        );
        return;
    }

    const { data } = await notifications(storeId, {
        params: {
            viewed_status: "unviewed",
        },
    });

    const schedulesForToday = data
        .filter(
            ({ scheduled_date }) =>
                scheduled_date === null ||
                scheduled_date === new Date().toISOString().split("T")[0]
        )
        .filter(({ scheduled_time }) => {
            if (scheduled_time === null) return true;

            const now = new Date();

            const time = `${String(now.getHours()).padStart(2, "0")}:${String(
                now.getMinutes()
            ).padStart(2, "0")}:00`;

            return scheduled_time === time;
        });

    const toastContainer = createContainer("div", "toast-container");

    const toastList = createContainer("ul", "toast-list");

    toastContainer.appendChild(toastList);

    toastList.append(createToastFragment(schedulesForToday));

    body.el.appendChild(toastContainer);
};
