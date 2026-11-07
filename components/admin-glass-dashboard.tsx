"use client";

import {
  useEffect,
  useId,
  useMemo,
  useRef,
  useState,
  type CSSProperties,
} from "react";
import { gsap } from "gsap";
import { useGSAP } from "@gsap/react";
import {
  LayoutDashboard,
  FolderKanban,
  Award,
  Mail,
  FileText,
  Users,
  User,
  ExternalLink,
  LogOut,
  Settings2,
  Sun,
  Moon,
  Search,
  Check,
  X,
  Layers,
  ArrowUpRight,
  ArrowRight,
  TrendingUp,
  Plus,
  Clock,
  ChevronRight,
  Inbox,
  Sparkles,
} from "lucide-react";

gsap.registerPlugin(useGSAP);

export type GlassSettings = {
  blur: number;
  opacity: number;
  saturation: number;
  tint: string;
  edge: number;
};

export interface AdminDashboardData {
  adminName: string;
  adminEmail?: string;
  projectCount: number;
  messageCount: number;
  certificateCount: number;
  articleCount: number;
  clientCount: number;
  recentMessages: {
    id: string;
    name: string;
    email: string;
    message: string;
    time: string;
    date: string;
  }[];
  recentProjects: {
    id: string;
    title: string;
    category: string;
    cover_image: string;
    updated_at: string;
  }[];
  recentCertificates: {
    id: string;
    name: string;
    issuer: string;
    is_pdf: boolean;
    image_url: string;
    updated_at: string;
  }[];
  chartData: {
    labels: string[];
    messages: number[];
    content: number[];
  };
  routes: {
    dashboard: string;
    projects: string;
    projectsCreate: string;
    certificates: string;
    certificatesCreate: string;
    articles: string;
    articlesCreate: string;
    clients: string;
    clientsCreate: string;
    about: string;
    messages: string;
    website: string;
    logout: string;
  };
  csrfToken: string;
}

const defaultGlass: GlassSettings = {
  blur: 22,
  opacity: 0.32,
  saturation: 1.25,
  tint: "#ffffff",
  edge: 0.6,
};

const tabs = [
  { id: "overview", label: "Ringkasan", icon: LayoutDashboard },
  { id: "messages", label: "Pesan Masuk", icon: Mail },
  { id: "content", label: "Koleksi Konten", icon: FolderKanban },
  { id: "analytics", label: "Statistik Interaksi", icon: TrendingUp },
] as const;
type TabView = (typeof tabs)[number]["id"];

const bounded = (value: number, min: number, max: number, fallback: number) =>
  Number.isFinite(value) ? Math.min(max, Math.max(min, value)) : fallback;

const normalize = (v: Partial<GlassSettings>): GlassSettings => ({
  blur: bounded(v.blur ?? defaultGlass.blur, 0, 40, defaultGlass.blur),
  opacity: bounded(v.opacity ?? defaultGlass.opacity, 0.08, 0.9, defaultGlass.opacity),
  saturation: bounded(v.saturation ?? defaultGlass.saturation, 0.5, 2, defaultGlass.saturation),
  edge: bounded(v.edge ?? defaultGlass.edge, 0, 1, defaultGlass.edge),
  tint: /^#[0-9a-f]{6}$/i.test(v.tint ?? "") ? v.tint! : defaultGlass.tint,
});

export default function AdminGlassDashboard({ data }: { data: AdminDashboardData }) {
  const root = useRef<HTMLDivElement>(null);
  const content = useRef<HTMLDivElement>(null);
  const settingsTrigger = useRef<HTMLButtonElement>(null);
  const id = useId().replace(/:/g, "");

  const [activeTab, setActiveTab] = useState<TabView>("overview");
  const [material, setMaterial] = useState<GlassSettings>(() => {
    try {
      const saved = localStorage.getItem("admin_glass_settings");
      if (saved) return normalize(JSON.parse(saved));
    } catch {
      // fallback
    }
    return defaultGlass;
  });
  const [settingsOpen, setSettingsOpen] = useState(false);
  const [theme, setTheme] = useState<"dark" | "light">("dark");
  const [filter, setFilter] = useState("");
  const [notice, setNotice] = useState("");

  const updateGlass = (patch: Partial<GlassSettings>) => {
    const next = normalize({ ...material, ...patch });
    setMaterial(next);
    try {
      localStorage.setItem("admin_glass_settings", JSON.stringify(next));
    } catch {
      // ignore
    }
  };

  const showToast = (msg: string) => {
    setNotice(msg);
  };

  useEffect(() => {
    if (!notice) return;
    const t = window.setTimeout(() => setNotice(""), 3000);
    return () => window.clearTimeout(t);
  }, [notice]);

  // GSAP animations for tab transitions
  useGSAP(
    () => {
      const mm = gsap.matchMedia();
      mm.add("(prefers-reduced-motion: no-preference)", () => {
        const panels = content.current?.querySelectorAll(".ag-reveal");
        if (!panels?.length) return;
        gsap.fromTo(
          panels,
          { y: 14, opacity: 0.35, filter: "blur(3px)" },
          {
            y: 0,
            opacity: 1,
            filter: "blur(0px)",
            duration: 0.45,
            stagger: 0.04,
            ease: "power3.out",
            clearProps: "transform,opacity,filter",
          }
        );
      });
      return () => mm.revert();
    },
    { scope: root, dependencies: [activeTab], revertOnUpdate: true }
  );

  // Filter messages
  const filteredMessages = useMemo(() => {
    if (!filter) return data.recentMessages;
    const q = filter.toLowerCase();
    return data.recentMessages.filter(
      (m) =>
        m.name.toLowerCase().includes(q) ||
        m.email.toLowerCase().includes(q) ||
        m.message.toLowerCase().includes(q)
    );
  }, [data.recentMessages, filter]);

  // Chart data calculations
  const chartPoints = useMemo(() => {
    const labels = data.chartData.labels || [];
    const msgs = data.chartData.messages || [];
    const contents = data.chartData.content || [];
    return labels.map((label, idx) => ({
      label,
      messages: msgs[idx] ?? 0,
      content: contents[idx] ?? 0,
    }));
  }, [data.chartData]);

  const maxVal = Math.max(
    1,
    ...chartPoints.flatMap((p) => [p.messages, p.content])
  );

  const chartX = (idx: number) =>
    chartPoints.length <= 1 ? 300 : (idx * 600) / (chartPoints.length - 1);
  const chartY = (val: number) => 170 - (val / maxVal) * 140;

  const msgPolyline = chartPoints
    .map((p, i) => `${chartX(i)},${chartY(p.messages)}`)
    .join(" ");
  const contentPolyline = chartPoints
    .map((p, i) => `${chartX(i)},${chartY(p.content)}`)
    .join(" ");

  return (
    <div
      ref={root}
      className="ag-root"
      data-theme={theme}
      style={
        {
          "--ag-blur": `${material.blur}px`,
          "--ag-opacity": material.opacity,
          "--ag-saturation": material.saturation,
          "--ag-edge": material.edge,
          "--ag-tint": material.tint,
        } as CSSProperties
      }
    >
      <style>{styles}</style>

      {/* Modern Wallpaper Backdrop */}
      <img
        className="ag-wallpaper"
        src="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=2160&q=80"
        alt="Glass Space"
      />
      <div className="ag-ambient-shade" aria-hidden="true" />

      <div className="ag-shell">
        {/* Topbar Navigation */}
        <header className="ag-topbar ag-glass">
          <div className="ag-brand-wrap">
            <span className="ag-brand-badge">
              <Layers size={18} strokeWidth={2} />
            </span>
            <div className="ag-brand-text">
              <strong>HANAFI</strong>
              <span>Portal Administrator</span>
            </div>
          </div>

          {/* Quick Nav Links */}
          <nav className="ag-top-nav">
            <a href={data.routes.projects} className="ag-nav-pill">
              <FolderKanban size={14} />
              <span>Portfolio</span>
            </a>
            <a href={data.routes.certificates} className="ag-nav-pill">
              <Award size={14} />
              <span>Sertifikat</span>
            </a>
            <a href={data.routes.articles} className="ag-nav-pill">
              <FileText size={14} />
              <span>Blog</span>
            </a>
            <a href={data.routes.clients} className="ag-nav-pill">
              <Users size={14} />
              <span>Klien</span>
            </a>
            <a href={data.routes.about} className="ag-nav-pill">
              <User size={14} />
              <span>Tentang</span>
            </a>
            <a href={data.routes.messages} className="ag-nav-pill">
              <Mail size={14} />
              <span>Inbox</span>
              {data.messageCount > 0 && (
                <span className="ag-pill-badge">{data.messageCount}</span>
              )}
            </a>
          </nav>

          {/* Action Toolbar */}
          <div className="ag-toolbar">
            <a
              href={data.routes.website}
              target="_blank"
              rel="noreferrer"
              className="ag-btn-ghost"
              title="Kunjungi Website Publik"
            >
              <ExternalLink size={15} />
              <span className="hidden sm:inline">Lihat Web</span>
            </a>

            <button
              type="button"
              ref={settingsTrigger}
              className="ag-btn-ghost"
              onClick={() => setSettingsOpen(!settingsOpen)}
              title="Sesuaikan efek kaca"
              aria-expanded={settingsOpen}
            >
              <Settings2 size={16} />
              <span className="hidden sm:inline">Efek Kaca</span>
            </button>

            <button
              type="button"
              className="ag-icon-btn"
              onClick={() => setTheme(theme === "dark" ? "light" : "dark")}
              title="Ganti Tema"
            >
              {theme === "dark" ? <Sun size={16} /> : <Moon size={16} />}
            </button>

            {/* Logout Form */}
            <form method="POST" action={data.routes.logout} className="m-0">
              <input type="hidden" name="_token" value={data.csrfToken} />
              <button
                type="submit"
                className="ag-logout-btn"
                title="Keluar dari Panel Admin"
              >
                <LogOut size={15} />
                <span className="hidden md:inline">Keluar</span>
              </button>
            </form>

            <div className="ag-user-avatar" title={data.adminName}>
              {data.adminName.slice(0, 1).toUpperCase()}
            </div>
          </div>
        </header>

        {/* Workspace Body */}
        <div className="ag-stage">
          {/* Left Vertical Dock */}
          <nav className="ag-rail ag-glass">
            {tabs.map((tab) => {
              const Icon = tab.icon;
              const isActive = activeTab === tab.id;
              return (
                <button
                  key={tab.id}
                  type="button"
                  className={`ag-rail-btn ${isActive ? "is-active" : ""}`}
                  onClick={() => setActiveTab(tab.id)}
                  title={tab.label}
                >
                  <Icon size={19} strokeWidth={1.8} />
                  <span>{tab.label}</span>
                </button>
              );
            })}
          </nav>

          {/* Main Glass Workspace */}
          <main className="ag-main ag-glass">
            {/* View Header */}
            <div className="ag-view-head">
              <div>
                <p className="ag-greeting">
                  Selamat Datang kembali, <strong>{data.adminName}</strong>
                </p>
                <h1>
                  {activeTab === "overview" && "Dashboard Administrator"}
                  {activeTab === "messages" && "Daftar Pesan Masuk"}
                  {activeTab === "content" && "Koleksi & Manajemen Konten"}
                  {activeTab === "analytics" && "Grafik & Statistik Interaksi"}
                </h1>
              </div>

              <div className="ag-head-actions">
                <a href={data.routes.projectsCreate} className="ag-cta-btn">
                  <Plus size={15} />
                  <span>Tambah Portfolio</span>
                </a>
              </div>
            </div>

            {/* Tab Panels */}
            <div ref={content} key={activeTab} className="ag-view-content">
              {/* TAB 1: OVERVIEW */}
              {activeTab === "overview" && (
                <>
                  {/* 5 Stats Cards Grid */}
                  <div className="ag-stats-grid">
                    <a
                      href={data.routes.projects}
                      className="ag-panel ag-stat-card ag-reveal group"
                    >
                      <div className="ag-stat-top">
                        <span>Total Portfolio</span>
                        <FolderKanban size={18} className="text-blue-400" />
                      </div>
                      <strong className="ag-stat-value">{data.projectCount}</strong>
                      <div className="ag-stat-link">
                        Kelola Portfolio <ArrowRight size={13} />
                      </div>
                    </a>

                    <a
                      href={data.routes.certificates}
                      className="ag-panel ag-stat-card ag-reveal group"
                    >
                      <div className="ag-stat-top">
                        <span>Total Sertifikat</span>
                        <Award size={18} className="text-emerald-400" />
                      </div>
                      <strong className="ag-stat-value">
                        {data.certificateCount}
                      </strong>
                      <div className="ag-stat-link">
                        Kelola Sertifikat <ArrowRight size={13} />
                      </div>
                    </a>

                    <a
                      href={data.routes.messages}
                      className="ag-panel ag-stat-card ag-reveal group"
                    >
                      <div className="ag-stat-top">
                        <span>Pesan Masuk</span>
                        <Mail size={18} className="text-amber-400" />
                      </div>
                      <strong className="ag-stat-value">
                        {data.messageCount}
                      </strong>
                      <div className="ag-stat-link">
                        Buka Inbox <ArrowRight size={13} />
                      </div>
                    </a>

                    <a
                      href={data.routes.articles}
                      className="ag-panel ag-stat-card ag-reveal group"
                    >
                      <div className="ag-stat-top">
                        <span>Artikel Blog</span>
                        <FileText size={18} className="text-purple-400" />
                      </div>
                      <strong className="ag-stat-value">
                        {data.articleCount}
                      </strong>
                      <div className="ag-stat-link">
                        Kelola Blog <ArrowRight size={13} />
                      </div>
                    </a>

                    <a
                      href={data.routes.clients}
                      className="ag-panel ag-stat-card ag-reveal group"
                    >
                      <div className="ag-stat-top">
                        <span>Klien / Mitra</span>
                        <Users size={18} className="text-pink-400" />
                      </div>
                      <strong className="ag-stat-value">{data.clientCount}</strong>
                      <div className="ag-stat-link">
                        Kelola Klien <ArrowRight size={13} />
                      </div>
                    </a>
                  </div>

                  {/* Interaction Traffic Chart */}
                  <section className="ag-panel ag-reveal ag-chart-panel">
                    <div className="ag-panel-header">
                      <div>
                        <h2>Statistik Interaksi Website</h2>
                        <p className="ag-muted-desc">
                          Pergerakan pesan masuk vs penambahan konten baru (14 hari terakhir)
                        </p>
                      </div>
                      <div className="ag-chart-legend">
                        <span className="is-messages">
                          <i /> Pesan Masuk
                        </span>
                        <span className="is-content">
                          <i /> Konten Baru
                        </span>
                      </div>
                    </div>

                    <div className="ag-chart-svg-wrap">
                      <svg
                        viewBox="0 0 600 180"
                        preserveAspectRatio="none"
                        className="ag-svg-chart"
                      >
                        <defs>
                          <linearGradient
                            id={`${id}-msg-grad`}
                            x1="0"
                            y1="0"
                            x2="0"
                            y2="1"
                          >
                            <stop
                              offset="0%"
                              stopColor="#3b82f6"
                              stopOpacity="0.32"
                            />
                            <stop
                              offset="100%"
                              stopColor="#3b82f6"
                              stopOpacity="0"
                            />
                          </linearGradient>
                        </defs>

                        {/* Guidelines */}
                        {[30, 90, 150].map((y) => (
                          <line
                            key={y}
                            x1="0"
                            y1={y}
                            x2="600"
                            y2={y}
                            stroke="currentColor"
                            strokeOpacity="0.08"
                            strokeDasharray="4 4"
                          />
                        ))}

                        {/* Message line */}
                        <polyline
                          points={msgPolyline}
                          fill="none"
                          stroke="#3b82f6"
                          strokeWidth="2.8"
                          strokeLinecap="round"
                          strokeLinejoin="round"
                        />

                        {/* Content line */}
                        <polyline
                          points={contentPolyline}
                          fill="none"
                          stroke="#a855f7"
                          strokeWidth="2.2"
                          strokeLinecap="round"
                          strokeLinejoin="round"
                          strokeDasharray="5 3"
                        />

                        {/* Dots */}
                        {chartPoints.map((p, i) => (
                          <g key={i}>
                            <circle
                              cx={chartX(i)}
                              cy={chartY(p.messages)}
                              r="3.5"
                              fill="#3b82f6"
                            />
                            <circle
                              cx={chartX(i)}
                              cy={chartY(p.content)}
                              r="3"
                              fill="#a855f7"
                            />
                          </g>
                        ))}
                      </svg>

                      {/* X-Axis Labels */}
                      <div className="ag-chart-dates">
                        {chartPoints.map(
                          (pt, idx) =>
                            (idx % 2 === 0 || idx === chartPoints.length - 1) && (
                              <span
                                key={idx}
                                style={{ left: `${(chartX(idx) / 600) * 100}%` }}
                              >
                                {pt.label}
                              </span>
                            )
                        )}
                      </div>
                    </div>
                  </section>

                  {/* Lower Split Grid: Messages & Content preview */}
                  <div className="ag-lower-grid">
                    {/* Recent Messages */}
                    <section className="ag-panel ag-reveal">
                      <div className="ag-panel-header">
                        <h2>Pesan Terbaru</h2>
                        <a href={data.routes.messages} className="ag-link-all">
                          Lihat semua <ChevronRight size={14} />
                        </a>
                      </div>

                      <div className="ag-message-list">
                        {data.recentMessages.length ? (
                          data.recentMessages.slice(0, 4).map((msg) => (
                            <div key={msg.id} className="ag-msg-item">
                              <div className="ag-msg-avatar">
                                <Mail size={16} />
                              </div>
                              <div className="ag-msg-info">
                                <div className="ag-msg-top">
                                  <strong>{msg.name}</strong>
                                  <span>{msg.time}</span>
                                </div>
                                <span className="ag-msg-email">{msg.email}</span>
                                <p className="ag-msg-snippet">{msg.message}</p>
                              </div>
                            </div>
                          ))
                        ) : (
                          <div className="ag-empty-box">
                            <Inbox size={28} />
                            <p>Belum ada pesan masuk.</p>
                          </div>
                        )}
                      </div>
                    </section>

                    {/* Recent Projects Showcase */}
                    <section className="ag-panel ag-reveal">
                      <div className="ag-panel-header">
                        <h2>Portfolio Terbaru</h2>
                        <a href={data.routes.projects} className="ag-link-all">
                          Semua item <ChevronRight size={14} />
                        </a>
                      </div>

                      <div className="ag-project-previews">
                        {data.recentProjects.length ? (
                          data.recentProjects.slice(0, 4).map((proj) => (
                            <div key={proj.id} className="ag-proj-row">
                              <img
                                src={proj.cover_image}
                                alt={proj.title}
                                className="ag-proj-thumb"
                                onError={(e) => {
                                  (e.target as HTMLImageElement).src =
                                    "https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=120&q=70";
                                }}
                              />
                              <div className="ag-proj-meta">
                                <strong>{proj.title}</strong>
                                <span>
                                  {proj.category} · {proj.updated_at}
                                </span>
                              </div>
                              <a
                                href={data.routes.projects}
                                className="ag-item-action"
                                title="Lihat di manager"
                              >
                                <ArrowUpRight size={15} />
                              </a>
                            </div>
                          ))
                        ) : (
                          <div className="ag-empty-box">
                            <FolderKanban size={28} />
                            <p>Belum ada portofolio dibuat.</p>
                          </div>
                        )}
                      </div>
                    </section>
                  </div>
                </>
              )}

              {/* TAB 2: MESSAGES INBOX */}
              {activeTab === "messages" && (
                <section className="ag-panel ag-reveal">
                  <div className="ag-panel-header">
                    <div>
                      <h2>Kotak Masuk Kontak</h2>
                      <p className="ag-muted-desc">
                        Total {data.recentMessages.length} pesan terbaru dari pengunjung situs
                      </p>
                    </div>

                    <div className="ag-search-bar">
                      <Search size={15} />
                      <input
                        type="text"
                        placeholder="Cari pengirim atau email..."
                        value={filter}
                        onChange={(e) => setFilter(e.target.value)}
                      />
                      {filter && (
                        <button type="button" onClick={() => setFilter("")}>
                          <X size={14} />
                        </button>
                      )}
                    </div>
                  </div>

                  <div className="ag-full-messages-list">
                    {filteredMessages.length ? (
                      filteredMessages.map((msg) => (
                        <div key={msg.id} className="ag-full-msg-card">
                          <div className="ag-card-head">
                            <div>
                              <h4>{msg.name}</h4>
                              <a href={`mailto:${msg.email}`}>{msg.email}</a>
                            </div>
                            <div className="ag-card-time">
                              <Clock size={13} />
                              <span>{msg.date || msg.time}</span>
                            </div>
                          </div>
                          <p className="ag-card-body">{msg.message}</p>
                          <div className="ag-card-footer">
                            <a
                              href={`mailto:${msg.email}?subject=Balasan Portofolio`}
                              className="ag-reply-btn"
                            >
                              Balas Email
                            </a>
                            <a
                              href={data.routes.messages}
                              className="ag-btn-subtle"
                            >
                              Buka di Inbox Panel &rarr;
                            </a>
                          </div>
                        </div>
                      ))
                    ) : (
                      <div className="ag-empty-box">
                        <Inbox size={32} />
                        <p>Tidak ditemukan pesan yang cocok.</p>
                      </div>
                    )}
                  </div>
                </section>
              )}

              {/* TAB 3: CONTENT COLLECTION */}
              {activeTab === "content" && (
                <div className="ag-content-grid ag-reveal">
                  {/* Projects Column */}
                  <section className="ag-panel">
                    <div className="ag-panel-header">
                      <div>
                        <h2>Portfolio Terkini</h2>
                        <span className="ag-badge-count">
                          {data.projectCount} Proyek
                        </span>
                      </div>
                      <a href={data.routes.projectsCreate} className="ag-mini-btn">
                        <Plus size={14} /> Tambah
                      </a>
                    </div>

                    <div className="ag-card-column">
                      {data.recentProjects.map((p) => (
                        <div key={p.id} className="ag-item-card">
                          <img
                            src={p.cover_image}
                            alt={p.title}
                            className="ag-card-img"
                            onError={(e) => {
                              (e.target as HTMLImageElement).src =
                                "https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=200&q=70";
                            }}
                          />
                          <div className="ag-card-detail">
                            <span className="ag-tag">{p.category}</span>
                            <strong>{p.title}</strong>
                            <small>{p.updated_at}</small>
                          </div>
                        </div>
                      ))}
                    </div>
                  </section>

                  {/* Certificates Column */}
                  <section className="ag-panel">
                    <div className="ag-panel-header">
                      <div>
                        <h2>Sertifikat Terkini</h2>
                        <span className="ag-badge-count">
                          {data.certificateCount} Dokumen
                        </span>
                      </div>
                      <a
                        href={data.routes.certificatesCreate}
                        className="ag-mini-btn"
                      >
                        <Plus size={14} /> Tambah
                      </a>
                    </div>

                    <div className="ag-card-column">
                      {data.recentCertificates.map((c) => (
                        <div key={c.id} className="ag-item-card">
                          <div className="ag-cert-badge">
                            <Award size={20} className="text-emerald-400" />
                          </div>
                          <div className="ag-card-detail">
                            <span className="ag-tag">{c.issuer}</span>
                            <strong>{c.name}</strong>
                            <small>{c.updated_at}</small>
                          </div>
                        </div>
                      ))}
                    </div>
                  </section>
                </div>
              )}

              {/* TAB 4: ANALYTICS */}
              {activeTab === "analytics" && (
                <section className="ag-panel ag-reveal">
                  <div className="ag-panel-header">
                    <div>
                      <h2>Detail Analisis Kunjungan & Interaksi</h2>
                      <p className="ag-muted-desc">
                        Rekapitulasi trafik formulir kontak dan update portofolio
                      </p>
                    </div>
                  </div>

                  <div className="ag-analytics-metrics">
                    <div className="ag-metric-box">
                      <span>Total Portofolio</span>
                      <strong>{data.projectCount}</strong>
                    </div>
                    <div className="ag-metric-box">
                      <span>Total Sertifikat</span>
                      <strong>{data.certificateCount}</strong>
                    </div>
                    <div className="ag-metric-box">
                      <span>Artikel Diterbitkan</span>
                      <strong>{data.articleCount}</strong>
                    </div>
                    <div className="ag-metric-box">
                      <span>Pesan Diterima</span>
                      <strong>{data.messageCount}</strong>
                    </div>
                  </div>

                  <div className="mt-8">
                    <h3 className="text-sm font-semibold mb-3">Tabel Log Harian (14 Hari)</h3>
                    <div className="ag-table-wrap">
                      <table className="ag-table">
                        <thead>
                          <tr>
                            <th>Tanggal</th>
                            <th>Pesan Masuk</th>
                            <th>Konten Baru</th>
                            <th>Status Aktivitas</th>
                          </tr>
                        </thead>
                        <tbody>
                          {chartPoints.map((row, i) => (
                            <tr key={i}>
                              <td>{row.label}</td>
                              <td>
                                <span className="ag-val-blue">
                                  {row.messages} Pesan
                                </span>
                              </td>
                              <td>
                                <span className="ag-val-purple">
                                  {row.content} Item
                                </span>
                              </td>
                              <td>
                                {row.messages + row.content > 0 ? (
                                  <span className="ag-pill-active">Ada Aktivitas</span>
                                ) : (
                                  <span className="ag-pill-idle">Sunyi</span>
                                )}
                              </td>
                            </tr>
                          ))}
                        </tbody>
                      </table>
                    </div>
                  </div>
                </section>
              )}
            </div>
          </main>
        </div>

        {/* Live Glass Customizer Drawer */}
        {settingsOpen && (
          <aside className="ag-drawer ag-glass">
            <div className="ag-drawer-header">
              <div className="flex items-center gap-2">
                <Settings2 size={18} />
                <h3>Pengaturan Material Kaca</h3>
              </div>
              <button
                type="button"
                className="ag-icon-btn"
                onClick={() => setSettingsOpen(false)}
              >
                <X size={17} />
              </button>
            </div>

            <p className="ag-drawer-desc">
              Kustomisasi transparansi, blur, dan saturasi efek kaca secara live.
            </p>

            {/* Presets */}
            <div className="ag-presets-bar">
              {[
                { name: "Clear", val: { blur: 8, opacity: 0.16, saturation: 1.1, edge: 0.8 } },
                { name: "Frosted", val: defaultGlass },
                { name: "Solid", val: { blur: 30, opacity: 0.85, saturation: 1, edge: 0.4 } },
              ].map((preset) => (
                <button
                  key={preset.name}
                  type="button"
                  onClick={() => {
                    updateGlass(preset.val);
                    showToast(`Preset ${preset.name} diterapkan.`);
                  }}
                >
                  {preset.name}
                </button>
              ))}
            </div>

            {/* Controls */}
            {[
              {
                key: "blur",
                label: "Blur Radius",
                min: 0,
                max: 40,
                step: 1,
                val: `${Math.round(material.blur)}px`,
              },
              {
                key: "opacity",
                label: "Opasitas Panel",
                min: 0.08,
                max: 0.9,
                step: 0.02,
                val: `${Math.round(material.opacity * 100)}%`,
              },
              {
                key: "saturation",
                label: "Saturasi Warna",
                min: 0.5,
                max: 2,
                step: 0.05,
                val: `${Math.round(material.saturation * 100)}%`,
              },
              {
                key: "edge",
                label: "Sorotan Tepi (Edge Light)",
                min: 0,
                max: 1,
                step: 0.05,
                val: `${Math.round(material.edge * 100)}%`,
              },
            ].map((c) => (
              <label key={c.key} className="ag-slider-row">
                <div className="flex justify-between text-xs">
                  <span>{c.label}</span>
                  <strong>{c.val}</strong>
                </div>
                <input
                  type="range"
                  min={c.min}
                  max={c.max}
                  step={c.step}
                  value={material[c.key as keyof GlassSettings]}
                  onChange={(e) =>
                    updateGlass({ [c.key]: Number(e.target.value) })
                  }
                />
              </label>
            ))}

            <label className="ag-color-row">
              <span>Warna Tint Kaca</span>
              <input
                type="color"
                value={material.tint}
                onChange={(e) => updateGlass({ tint: e.target.value })}
              />
            </label>

            <button
              type="button"
              className="ag-reset-btn"
              onClick={() => {
                updateGlass(defaultGlass);
                showToast("Pengaturan kaca direset ke bawaan.");
              }}
            >
              Reset ke Bawaan
            </button>
          </aside>
        )}
      </div>

      {/* Toast Notification */}
      {notice && (
        <div className="ag-toast">
          <Sparkles size={16} />
          <span>{notice}</span>
        </div>
      )}
    </div>
  );
}

const styles = `
.ag-root {
  position: relative;
  min-height: 100svh;
  overflow-x: hidden;
  background: #09090b;
  color: #f4f4f5;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Inter", sans-serif;
  letter-spacing: -0.015em;
  padding: 24px 28px;
  box-sizing: border-box;
  isolation: isolate;
}
.ag-root[data-theme="light"] {
  background: #f4f4f5;
  color: #18181b;
}

.ag-wallpaper {
  position: fixed;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center 40%;
  z-index: -3;
  opacity: 0.85;
}
.ag-ambient-shade {
  position: fixed;
  inset: 0;
  background: radial-gradient(circle at 50% 0%, rgba(59, 130, 246, 0.12), transparent 75%),
              rgba(10, 10, 15, 0.65);
  z-index: -2;
  pointer-events: none;
}
[data-theme="light"] .ag-ambient-shade {
  background: rgba(245, 245, 247, 0.72);
}

.ag-shell {
  max-width: 1360px;
  margin: 0 auto;
}

/* Glass Surface Styles */
.ag-glass {
  background: color-mix(in srgb, rgba(20, 20, 26, 0.85) calc(var(--ag-opacity) * 100%), transparent);
  backdrop-filter: blur(var(--ag-blur)) saturate(var(--ag-saturation));
  -webkit-backdrop-filter: blur(var(--ag-blur)) saturate(var(--ag-saturation));
  border: 1px solid color-mix(in srgb, rgba(255, 255, 255, 0.4) calc(var(--ag-edge) * 100%), transparent);
  box-shadow: 0 20px 50px -15px rgba(0, 0, 0, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.15);
  position: relative;
}
[data-theme="light"] .ag-glass {
  background: color-mix(in srgb, rgba(255, 255, 255, 0.88) calc(var(--ag-opacity) * 100%), transparent);
  border-color: color-mix(in srgb, rgba(0, 0, 0, 0.15) calc(var(--ag-edge) * 100%), transparent);
  box-shadow: 0 16px 40px -10px rgba(0, 0, 0, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.8);
}
.ag-glass:before {
  content: "";
  position: absolute;
  inset: 0;
  background: var(--ag-tint);
  opacity: 0.08;
  pointer-events: none;
  border-radius: inherit;
}

/* Topbar */
.ag-topbar {
  border-radius: 20px;
  height: 64px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 22px;
  margin-bottom: 20px;
  gap: 16px;
}
.ag-brand-wrap {
  display: flex;
  align-items: center;
  gap: 12px;
}
.ag-brand-badge {
  width: 34px;
  height: 34px;
  background: linear-gradient(135deg, #3b82f6, #1d4ed8);
  color: #fff;
  border-radius: 10px;
  display: grid;
  place-items: center;
  box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
}
.ag-brand-text {
  display: flex;
  flex-direction: column;
}
.ag-brand-text strong {
  font-size: 14px;
  letter-spacing: -0.02em;
}
.ag-brand-text span {
  font-size: 11px;
  opacity: 0.65;
}

.ag-top-nav {
  display: flex;
  align-items: center;
  gap: 6px;
}
@media (max-width: 900px) {
  .ag-top-nav {
    display: none;
  }
}
.ag-nav-pill {
  display: flex;
  align-items: center;
  gap: 7px;
  padding: 7px 12px;
  border-radius: 9px;
  font-size: 12px;
  font-weight: 500;
  color: inherit;
  text-decoration: none;
  transition: all 0.2s;
}
.ag-nav-pill:hover {
  background: rgba(255, 255, 255, 0.08);
}
[data-theme="light"] .ag-nav-pill:hover {
  background: rgba(0, 0, 0, 0.05);
}
.ag-pill-badge {
  background: #3b82f6;
  color: #fff;
  padding: 1px 6px;
  border-radius: 999px;
  font-size: 10px;
  font-weight: 700;
}

.ag-toolbar {
  display: flex;
  align-items: center;
  gap: 10px;
}
.ag-btn-ghost {
  display: flex;
  align-items: center;
  gap: 7px;
  padding: 7px 12px;
  border-radius: 9px;
  border: 1px solid rgba(255, 255, 255, 0.12);
  background: rgba(255, 255, 255, 0.04);
  color: inherit;
  font-size: 12px;
  font-weight: 500;
  text-decoration: none;
  cursor: pointer;
}
.ag-btn-ghost:hover {
  background: rgba(255, 255, 255, 0.1);
}
.ag-icon-btn {
  width: 34px;
  height: 34px;
  border-radius: 50%;
  border: 0;
  background: rgba(255, 255, 255, 0.06);
  color: inherit;
  display: grid;
  place-items: center;
  cursor: pointer;
}
.ag-icon-btn:hover {
  background: rgba(255, 255, 255, 0.12);
}
.ag-logout-btn {
  display: flex;
  align-items: center;
  gap: 6px;
  padding: 7px 12px;
  border-radius: 9px;
  border: 0;
  background: rgba(239, 68, 68, 0.15);
  color: #f87171;
  font-size: 12px;
  font-weight: 600;
  cursor: pointer;
}
.ag-logout-btn:hover {
  background: rgba(239, 68, 68, 0.25);
}
.ag-user-avatar {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: linear-gradient(135deg, #4f46e5, #7c3aed);
  color: #fff;
  display: grid;
  place-items: center;
  font-size: 13px;
  font-weight: 700;
}

/* Stage Layout */
.ag-stage {
  display: flex;
  gap: 16px;
}
.ag-rail {
  width: 60px;
  border-radius: 22px;
  padding: 12px 6px;
  display: flex;
  flex-direction: column;
  gap: 12px;
  height: fit-content;
}
@media (max-width: 768px) {
  .ag-rail {
    display: none;
  }
}
.ag-rail-btn {
  width: 48px;
  height: 48px;
  border-radius: 14px;
  border: 0;
  background: none;
  color: inherit;
  opacity: 0.6;
  display: grid;
  place-items: center;
  cursor: pointer;
  transition: all 0.2s;
}
.ag-rail-btn span {
  display: none;
}
.ag-rail-btn:hover {
  opacity: 1;
  background: rgba(255, 255, 255, 0.08);
}
.ag-rail-btn.is-active {
  opacity: 1;
  background: #3b82f6;
  color: #fff;
  box-shadow: 0 4px 14px rgba(59, 130, 246, 0.45);
}

.ag-main {
  flex: 1;
  min-width: 0;
  border-radius: 24px;
  padding: 28px 32px 40px;
}

/* View Head */
.ag-view-head {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 26px;
}
.ag-greeting {
  font-size: 13px;
  opacity: 0.65;
  margin-bottom: 4px;
}
.ag-view-head h1 {
  font-size: 26px;
  font-weight: 600;
  margin: 0;
  letter-spacing: -0.03em;
}
.ag-cta-btn {
  display: flex;
  align-items: center;
  gap: 7px;
  background: #3b82f6;
  color: #fff;
  padding: 9px 16px;
  border-radius: 11px;
  font-size: 12px;
  font-weight: 600;
  text-decoration: none;
  box-shadow: 0 4px 12px rgba(59, 130, 246, 0.35);
}
.ag-cta-btn:hover {
  background: #2563eb;
}

/* Panels */
.ag-panel {
  background: rgba(255, 255, 255, 0.04);
  border-radius: 18px;
  border: 1px solid rgba(255, 255, 255, 0.08);
  padding: 20px 22px;
}
[data-theme="light"] .ag-panel {
  background: rgba(0, 0, 0, 0.02);
  border-color: rgba(0, 0, 0, 0.06);
}
.ag-panel-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 18px;
}
.ag-panel-header h2 {
  font-size: 15px;
  font-weight: 600;
  margin: 0;
}
.ag-muted-desc {
  font-size: 11px;
  opacity: 0.6;
  margin-top: 3px;
}

/* 5 Stats Grid */
.ag-stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
  gap: 14px;
  margin-bottom: 18px;
}
.ag-stat-card {
  display: flex;
  flex-direction: column;
  text-decoration: none;
  color: inherit;
  transition: transform 0.2s, border-color 0.2s;
}
.ag-stat-card:hover {
  transform: translateY(-2px);
  border-color: rgba(59, 130, 246, 0.4);
}
.ag-stat-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 12px;
  opacity: 0.7;
}
.ag-stat-value {
  font-size: 32px;
  font-weight: 600;
  margin: 8px 0 10px;
  letter-spacing: -0.04em;
}
.ag-stat-link {
  font-size: 11px;
  color: #3b82f6;
  display: flex;
  align-items: center;
  gap: 4px;
  margin-top: auto;
}

/* Chart Panel */
.ag-chart-panel {
  margin-bottom: 18px;
}
.ag-chart-legend {
  display: flex;
  align-items: center;
  gap: 16px;
  font-size: 11px;
}
.ag-chart-legend span {
  display: flex;
  align-items: center;
  gap: 6px;
}
.ag-chart-legend i {
  width: 8px;
  height: 8px;
  border-radius: 50%;
}
.ag-chart-legend .is-messages i {
  background: #3b82f6;
}
.ag-chart-legend .is-content i {
  background: #a855f7;
}

.ag-chart-svg-wrap {
  position: relative;
  height: 180px;
  width: 100%;
}
.ag-svg-chart {
  width: 100%;
  height: 150px;
  overflow: visible;
}
.ag-chart-dates {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 20px;
  font-size: 10px;
  opacity: 0.55;
}
.ag-chart-dates span {
  position: absolute;
  transform: translateX(-50%);
  white-space: nowrap;
}

/* Lower Split Grid */
.ag-lower-grid {
  display: grid;
  grid-template-columns: 1.2fr 1fr;
  gap: 16px;
}
@media (max-width: 960px) {
  .ag-lower-grid {
    grid-template-columns: 1fr;
  }
}
.ag-link-all {
  font-size: 11px;
  color: #3b82f6;
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 3px;
}
.ag-message-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}
.ag-msg-item {
  display: flex;
  gap: 12px;
  padding: 10px;
  border-radius: 12px;
  background: rgba(255, 255, 255, 0.02);
  border: 1px solid rgba(255, 255, 255, 0.05);
}
.ag-msg-avatar {
  width: 34px;
  height: 34px;
  border-radius: 10px;
  background: rgba(59, 130, 246, 0.15);
  color: #60a5fa;
  display: grid;
  place-items: center;
  flex-shrink: 0;
}
.ag-msg-info {
  flex: 1;
  min-width: 0;
}
.ag-msg-top {
  display: flex;
  justify-content: space-between;
  align-items: baseline;
}
.ag-msg-top strong {
  font-size: 13px;
}
.ag-msg-top span {
  font-size: 10px;
  opacity: 0.5;
}
.ag-msg-email {
  font-size: 11px;
  color: #3b82f6;
  display: block;
}
.ag-msg-snippet {
  font-size: 11px;
  opacity: 0.7;
  margin: 4px 0 0;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Project Previews */
.ag-project-previews {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.ag-proj-row {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 8px;
  border-radius: 10px;
  background: rgba(255, 255, 255, 0.02);
  border: 1px solid rgba(255, 255, 255, 0.04);
}
.ag-proj-thumb {
  width: 44px;
  height: 32px;
  object-fit: cover;
  border-radius: 6px;
  flex-shrink: 0;
}
.ag-proj-meta {
  flex: 1;
  min-width: 0;
}
.ag-proj-meta strong {
  font-size: 12px;
  display: block;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.ag-proj-meta span {
  font-size: 10px;
  opacity: 0.6;
}
.ag-item-action {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  display: grid;
  place-items: center;
  color: inherit;
  opacity: 0.6;
  text-decoration: none;
}
.ag-item-action:hover {
  opacity: 1;
  background: rgba(255, 255, 255, 0.1);
}

/* Search bar */
.ag-search-bar {
  display: flex;
  align-items: center;
  gap: 8px;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
  padding: 6px 12px;
  border-radius: 10px;
}
.ag-search-bar input {
  background: none;
  border: 0;
  outline: none;
  font-size: 12px;
  color: inherit;
  width: 200px;
}

/* Full messages cards */
.ag-full-messages-list {
  display: flex;
  flex-direction: column;
  gap: 14px;
}
.ag-full-msg-card {
  padding: 16px 18px;
  border-radius: 14px;
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.06);
}
.ag-card-head {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 10px;
}
.ag-card-head h4 {
  font-size: 14px;
  font-weight: 600;
  margin: 0;
}
.ag-card-head a {
  font-size: 12px;
  color: #3b82f6;
  text-decoration: none;
}
.ag-card-time {
  display: flex;
  align-items: center;
  gap: 5px;
  font-size: 11px;
  opacity: 0.6;
}
.ag-card-body {
  font-size: 13px;
  line-height: 1.6;
  opacity: 0.85;
  margin: 0 0 14px;
}
.ag-card-footer {
  display: flex;
  align-items: center;
  gap: 12px;
}
.ag-reply-btn {
  background: #3b82f6;
  color: #fff;
  font-size: 11px;
  font-weight: 600;
  padding: 6px 14px;
  border-radius: 8px;
  text-decoration: none;
}
.ag-btn-subtle {
  font-size: 11px;
  color: inherit;
  opacity: 0.7;
  text-decoration: none;
}
.ag-btn-subtle:hover {
  opacity: 1;
  text-decoration: underline;
}

/* Content Tab */
.ag-content-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
}
@media (max-width: 800px) {
  .ag-content-grid {
    grid-template-columns: 1fr;
  }
}
.ag-badge-count {
  font-size: 11px;
  opacity: 0.6;
}
.ag-mini-btn {
  display: flex;
  align-items: center;
  gap: 4px;
  padding: 5px 10px;
  border-radius: 8px;
  background: #3b82f6;
  color: #fff;
  font-size: 11px;
  font-weight: 600;
  text-decoration: none;
}
.ag-card-column {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.ag-item-card {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 10px;
  border-radius: 12px;
  background: rgba(255, 255, 255, 0.02);
  border: 1px solid rgba(255, 255, 255, 0.05);
}
.ag-card-img {
  width: 50px;
  height: 38px;
  border-radius: 6px;
  object-fit: cover;
}
.ag-cert-badge {
  width: 44px;
  height: 44px;
  border-radius: 10px;
  background: rgba(16, 185, 129, 0.15);
  display: grid;
  place-items: center;
}
.ag-card-detail {
  display: flex;
  flex-direction: column;
}
.ag-tag {
  font-size: 9px;
  font-weight: 700;
  text-transform: uppercase;
  color: #3b82f6;
}
.ag-card-detail strong {
  font-size: 13px;
  margin: 1px 0;
}
.ag-card-detail small {
  font-size: 10px;
  opacity: 0.55;
}

/* Analytics Tab */
.ag-analytics-metrics {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
  gap: 14px;
}
.ag-metric-box {
  padding: 16px;
  border-radius: 14px;
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.06);
}
.ag-metric-box span {
  font-size: 12px;
  opacity: 0.65;
}
.ag-metric-box strong {
  display: block;
  font-size: 26px;
  margin-top: 6px;
}
.ag-table-wrap {
  overflow-x: auto;
}
.ag-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 12px;
}
.ag-table th, .ag-table td {
  padding: 10px 14px;
  text-align: left;
  border-bottom: 1px solid rgba(255, 255, 255, 0.06);
}
.ag-table th {
  opacity: 0.5;
  font-weight: 500;
}
.ag-val-blue {
  color: #60a5fa;
  font-weight: 600;
}
.ag-val-purple {
  color: #c084fc;
  font-weight: 600;
}
.ag-pill-active {
  background: rgba(16, 185, 129, 0.15);
  color: #34d399;
  padding: 2px 8px;
  border-radius: 999px;
  font-size: 10px;
  font-weight: 600;
}
.ag-pill-idle {
  opacity: 0.45;
  font-size: 11px;
}

/* Drawer / Glass Settings */
.ag-drawer {
  position: fixed;
  top: 96px;
  right: 28px;
  width: 310px;
  border-radius: 20px;
  padding: 22px;
  z-index: 50;
  box-shadow: 0 25px 60px rgba(0, 0, 0, 0.6);
}
.ag-drawer-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.ag-drawer-header h3 {
  font-size: 14px;
  font-weight: 600;
  margin: 0;
}
.ag-drawer-desc {
  font-size: 11px;
  opacity: 0.65;
  margin: 6px 0 16px;
}
.ag-presets-bar {
  display: flex;
  gap: 6px;
  margin-bottom: 16px;
}
.ag-presets-bar button {
  flex: 1;
  padding: 6px;
  border-radius: 8px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  background: rgba(255, 255, 255, 0.05);
  color: inherit;
  font-size: 11px;
  cursor: pointer;
}
.ag-presets-bar button:hover {
  background: rgba(255, 255, 255, 0.12);
}
.ag-slider-row {
  display: block;
  margin-bottom: 14px;
}
.ag-slider-row input {
  width: 100%;
  margin-top: 6px;
  accent-color: #3b82f6;
  cursor: pointer;
}
.ag-color-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 12px;
  margin: 16px 0;
}
.ag-color-row input {
  width: 36px;
  height: 26px;
  border: 0;
  border-radius: 6px;
  background: none;
  cursor: pointer;
}
.ag-reset-btn {
  width: 100%;
  padding: 8px;
  border-radius: 8px;
  border: 1px solid rgba(255, 255, 255, 0.12);
  background: none;
  color: inherit;
  font-size: 11px;
  cursor: pointer;
}
.ag-reset-btn:hover {
  background: rgba(255, 255, 255, 0.08);
}

/* Toast */
.ag-toast {
  position: fixed;
  bottom: 24px;
  left: 50%;
  transform: translateX(-50%);
  background: #3b82f6;
  color: #fff;
  padding: 10px 18px;
  border-radius: 12px;
  font-size: 12px;
  font-weight: 500;
  display: flex;
  align-items: center;
  gap: 8px;
  box-shadow: 0 10px 30px rgba(59, 130, 246, 0.4);
  z-index: 99;
}
.ag-empty-box {
  text-align: center;
  padding: 40px 10px;
  opacity: 0.5;
  font-size: 12px;
}
.ag-empty-box svg {
  margin: 0 auto 8px;
}
`;
