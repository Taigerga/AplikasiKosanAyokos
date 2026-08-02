import { describe, it, expect, beforeEach } from 'vitest';
import { setLoading, getSpinnerHtml } from '../utils/loading';

describe('loading.js', () => {
    describe('setLoading', () => {
        let btn;

        beforeEach(() => {
            btn = document.createElement('button');
            btn.innerHTML = 'Simpan';
            document.body.appendChild(btn);
        });

        it('should disable button and show spinner on loading', () => {
            setLoading(btn, true);
            expect(btn.disabled).toBe(true);
            expect(btn.innerHTML).toContain('animate-spin');
            expect(btn.innerHTML).toContain('Memproses...');
        });

        it('should restore original content when done loading', () => {
            setLoading(btn, true);
            setLoading(btn, false);
            expect(btn.disabled).toBe(false);
            expect(btn.innerHTML).toBe('Simpan');
        });

        it('should handle null element gracefully', () => {
            expect(() => setLoading(null, true)).not.toThrow();
        });
    });

    describe('getSpinnerHtml', () => {
        it('should return spinner SVG with default size', () => {
            const html = getSpinnerHtml();
            expect(html).toContain('animate-spin');
            expect(html).toContain('h-4 w-4');
        });

        it('should return spinner SVG with custom size', () => {
            const html = getSpinnerHtml('h-8 w-8');
            expect(html).toContain('h-8 w-8');
        });
    });
});
