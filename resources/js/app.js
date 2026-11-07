import Alpine from 'alpinejs';
import React from 'react';
import ReactDOM from 'react-dom/client';
import GlassWorkspaceDemo from '@/components/ui/demo';
import AdminGlassDashboard from '@/components/admin-glass-dashboard';

window.Alpine = Alpine;
Alpine.start();

// Mount Component Demo (/glass-dashboard)
const rootElement = document.getElementById('glass-dashboard-root');
if (rootElement) {
    ReactDOM.createRoot(rootElement).render(
        React.createElement(React.StrictMode, null, React.createElement(GlassWorkspaceDemo))
    );
}

// Mount Full-Page Admin Glass Dashboard
const adminRoot = document.getElementById('admin-glass-dashboard-root');
if (adminRoot) {
    try {
        const rawData = adminRoot.getAttribute('data-dashboard');
        const dashboardData = rawData ? JSON.parse(rawData) : null;
        if (dashboardData) {
            ReactDOM.createRoot(adminRoot).render(
                React.createElement(
                    React.StrictMode,
                    null,
                    React.createElement(AdminGlassDashboard, { data: dashboardData })
                )
            );
        }
    } catch (err) {
        console.error('Error mounting Admin Glass Dashboard:', err);
    }
}
