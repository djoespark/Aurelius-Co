<div class="space-y-16">

    <div class="space-y-8">

        <div class="flex justify-between items-end">
            <span class="text-silk/30 text-[10px] uppercase tracking-[0.3em]">
                Apport Personnel
            </span>

            <span class="text-gold font-serif text-4xl"
                  x-text="contribution + '%'">
            </span>
        </div>

        <input type="range"
               x-model="contribution"
               min="0"
               max="100"
               class="w-full h-[1px] bg-gold/20 appearance-none accent-gold cursor-pointer">

    </div>

</div>