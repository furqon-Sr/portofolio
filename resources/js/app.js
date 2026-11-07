import Alpine from 'alpinejs';
import React from 'react';
import ReactDOM from 'react-dom/client';
import GlassWorkspaceDemo from '@/components/ui/demo';

window.Alpine = Alpine;
Alpine.start();

const rootElement = document.getElementById('glass-dashboard-root');
if (rootElement) {
    ReactDOM.createRoot(rootElement).render(
        React.createElement(React.StrictMode, null, React.createElement(GlassWorkspaceDemo))
    );
}
