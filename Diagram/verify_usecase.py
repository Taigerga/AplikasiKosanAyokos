import re, os

DIR = r"D:\laragon\www\AplikasiKosanAyokos\Diagram"

files = {
    'use-case-guest-penghuni.drawio': {'expect_actor_assocs': 16, 'expect_uc': 25},
    'use-case-pemilik.drawio': {'expect_actor_assocs': 22, 'expect_uc': 22},
    'use-case-admin-sistem.drawio': {'expect_actor_assocs': 13, 'expect_uc': 18},
    'use-case-master.drawio': {'expect_actor_assocs': 21, 'expect_uc': 21},
}

for fname, exp in files.items():
    fpath = os.path.join(DIR, fname)
    with open(fpath, 'r') as f:
        content = f.read()
    
    uc_count = len(re.findall(r'UC-\d+', content))
    actor_assocs = len(re.findall(r'source="(pengunjung|penghuni|pemilik|admin|4|5|6)" target="(\w+)"', content))
    actors = len(re.findall(r'style=".*shape=umlActor.*"', content))
    has_endfill0 = 'endFill=0' in content
    
    status = "OK" if (actor_assocs >= exp['expect_actor_assocs'] and uc_count >= exp['expect_uc']) else "MISMATCH"
    print(f"[{status}] {fname}: {actor_assocs} actor assocs (exp>={exp['expect_actor_assocs']}), {uc_count} UC (exp>={exp['expect_uc']}), {actors} actors, hollow={has_endfill0}")

print("\nAll files present:")
for f in ['use-case-guest-penghuni.drawio.png', 'use-case-pemilik.drawio.png', 'use-case-admin-sistem.drawio.png', 'use-case-master.drawio.png']:
    exists = os.path.exists(os.path.join(DIR, f))
    # Also check regular png
    reg = f.replace('.drawio.png', '.png')
    exists_reg = os.path.exists(os.path.join(DIR, reg))
    print(f"  {reg}: {'EXISTS' if exists_reg else 'MISSING'}")
    print(f"  {f}: {'EXISTS' if exists else 'NOT YET (final)'}")
