import { createFileRoute } from "@tanstack/react-router";
import { useState } from "react";
import { Wrench, Gauge, Droplet, CircleDot, BatteryCharging, Snowflake, Info } from "lucide-react";
import seatLeon from "@/assets/seat-leon-xray.jpg";

export const Route = createFileRoute("/")({
  component: Index,
});

type ServiceId = "diagnosis" | "mantenimiento" | "aceite" | "neumaticos" | "baterias" | "aire";

interface Service {
  id: ServiceId;
  label: string;
  icon: typeof Wrench;
  // position over the car image, in %
  top: string;
  left: string;
  description: string;
}

const services: Service[] = [
  {
    id: "diagnosis",
    label: "Diagnosis",
    icon: Gauge,
    top: "55%",
    left: "78%",
    description:
      "Diagnóstico electrónico completo de todos los sistemas del vehículo. Detectamos averías mediante equipos multimarca de última generación.",
  },
  {
    id: "mantenimiento",
    label: "Mantenimiento",
    icon: Wrench,
    top: "40%",
    left: "70%",
    description:
      "Revisiones periódicas según el plan del fabricante: filtros, correas, frenos, suspensión y puesta a punto general.",
  },
  {
    id: "aceite",
    label: "Cambio de aceite",
    icon: Droplet,
    top: "62%",
    left: "62%",
    description:
      "Cambio de aceite y filtro con lubricantes de primera marca, adaptados a las especificaciones de cada motor.",
  },
  {
    id: "neumaticos",
    label: "Neumáticos",
    icon: CircleDot,
    top: "78%",
    left: "78%",
    description:
      "Trabajamos con todas las marcas del mercado y realizamos cambios de neumáticos de todo tipo de vehículos: turismos, 4x4 y furgonetas. Reparación y alineación.",
  },
  {
    id: "baterias",
    label: "Baterías",
    icon: BatteryCharging,
    top: "48%",
    left: "55%",
    description:
      "Comprobación, carga y sustitución de baterías. Disponemos de baterías para todo tipo de vehículos, incluidos start-stop.",
  },
  {
    id: "aire",
    label: "Aire acondicionado",
    icon: Snowflake,
    top: "35%",
    left: "48%",
    description:
      "Recarga, mantenimiento y reparación del sistema de aire acondicionado y climatización. Dejamos tu coche a punto para cualquier estación.",
  },
];

function Index() {
  const [activeId, setActiveId] = useState<ServiceId>("neumaticos");
  const active = services.find((s) => s.id === activeId)!;

  return (
    <main className="min-h-screen bg-background">
      <section className="mx-auto max-w-6xl px-4 py-10">
        <h1 className="text-3xl md:text-4xl font-bold tracking-tight text-foreground">
          Nuestros servicios
        </h1>
        <p className="mt-2 text-muted-foreground">
          Pulsa sobre los iconos del coche para ver el detalle de cada servicio.
        </p>

        {/* Tabs */}
        <div className="mt-8 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-2">
          {services.map((s) => {
            const Icon = s.icon;
            const isActive = s.id === activeId;
            return (
              <button
                key={s.id}
                onClick={() => setActiveId(s.id)}
                className={`group relative flex flex-col items-center justify-center gap-2 rounded-lg border bg-card px-3 py-4 transition-all hover:border-primary hover:shadow-sm ${
                  isActive ? "border-primary shadow-sm" : "border-border"
                }`}
              >
                <Icon className={`h-7 w-7 ${isActive ? "text-primary" : "text-foreground"}`} />
                <span className="text-sm font-semibold text-foreground text-center">{s.label}</span>
                <span
                  className={`absolute bottom-0 left-1/2 h-0.5 -translate-x-1/2 bg-primary transition-all ${
                    isActive ? "w-2/3" : "w-0"
                  }`}
                />
              </button>
            );
          })}
        </div>

        {/* Image + info panel */}
        <div className="mt-6">
          <div className="relative">
            {/* Watermark */}
            <div className="pointer-events-none absolute inset-0 flex items-center justify-center">
              <span className="text-5xl sm:text-7xl font-bold text-foreground/5 select-none">
                Servicios
              </span>
            </div>

            {/* Car with hotspots */}
            <div className="relative overflow-hidden rounded-lg">
              <img
                src={seatLeon}
                alt="Seat León mk2 con vista de rayos X"
                width={1280}
                height={768}
                className="w-full h-auto object-contain"
              />

              {/* Info panel overlaid on image */}
              <div className="absolute top-4 left-4 z-10 max-w-sm rounded-md bg-foreground/60 backdrop-blur-sm p-4 shadow-lg border border-white/10 text-white">
                <div className="flex items-start gap-3">
                  <Info className="h-5 w-5 text-white shrink-0 mt-0.5" />
                  <div>
                    <h2 className="text-base font-semibold">{active.label}</h2>
                    <p className="mt-1 text-sm leading-relaxed text-white/90">{active.description}</p>
                  </div>
                </div>
              </div>

              {services.map((s) => {
                const Icon = s.icon;
                const isActive = s.id === activeId;
                return (
                  <button
                    key={s.id}
                    onClick={() => setActiveId(s.id)}
                    aria-label={s.label}
                    style={{ top: s.top, left: s.left }}
                    className={`absolute -translate-x-1/2 -translate-y-1/2 flex h-10 w-10 sm:h-12 sm:w-12 items-center justify-center rounded-full shadow-md transition-all hover:scale-110 ${
                      isActive
                        ? "bg-primary text-primary-foreground ring-4 ring-primary/30 scale-110"
                        : "bg-card text-foreground"
                    }`}
                  >
                    <Icon className="h-5 w-5 sm:h-6 sm:w-6" />
                  </button>
                );
              })}

              {/* Más información button overlaid on image */}
              <div className="absolute bottom-4 right-4 z-10">
                <button className="rounded-md border border-white/20 bg-foreground/60 backdrop-blur-sm px-5 py-2 text-sm font-medium text-white hover:bg-foreground/80 transition-colors shadow-lg">
                  Más información
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  );
}
